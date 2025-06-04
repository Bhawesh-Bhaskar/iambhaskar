<?php
namespace App\Http\Helpers;

use Session;
use Config;
use Exception;
use Carbon\Carbon;
use App\Models\Backup;
use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Setting;

class Common
{
    public function backup_tables($host, $user, $pass, $name, $tables = '*')
    {
        try {
            $con = mysqli_connect($host, $user, $pass, $name);
        }
        catch (Exception $e)
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }

        if (mysqli_connect_errno())
        {
            $message = array('flag'=>'alert-danger', 'message'=>'Failed to connect to MySQL: ' . mysqli_connect_error());
            return back()->with(['message'=>$message]);
        }

        $con->set_charset("utf8mb4");

        if ($tables == '*')
        {
            $tables = array();
            $result = mysqli_query($con, 'SHOW TABLES');
            while ($row = mysqli_fetch_row($result))
            {
                $tables[] = $row[0];
            }
        }
        else
        {
            $tables = is_array($tables) ? $tables : explode(',', $tables);
        }

        $return = '';
        foreach ($tables as $table)
        {
            $result     = mysqli_query($con, 'SELECT * FROM ' . $table);
            $num_fields = mysqli_num_fields($result);

            $row2 = mysqli_fetch_row(mysqli_query($con, 'SHOW CREATE TABLE ' . $table));
            $return .= "\n\n" . str_replace("CREATE TABLE", "CREATE TABLE IF NOT EXISTS", $row2[1]) . ";\n\n";

            for ($i = 0; $i < $num_fields; $i++)
            {
                while ($row = mysqli_fetch_row($result))
                {
                    $return .= 'INSERT INTO ' . $table . ' VALUES(';
                    for ($j = 0; $j < $num_fields; $j++)
                    {
                        $row[$j] = addslashes($row[$j]);
                        $row[$j] = preg_replace("/\n/", "\\n", $row[$j]);
                        if (isset($row[$j]))
                        {
                            $return .= '"' . $row[$j] . '"';
                        }
                        else
                        {
                            $return .= '""';
                        }
                        if ($j < ($num_fields - 1))
                        {
                            $return .= ',';
                        }
                    }
                    $return .= ");\n";
                }
            }

            $return .= "\n\n\n";
        }

        $backup_name = date('Y-m-d-His') . '.sql';
        $directoryPath = public_path('assets/img/backups');
        $handle = fopen($directoryPath . '/' . $backup_name, 'w+');
        fwrite($handle, $return);
        fclose($handle);

        return $backup_name;
    }

    public static function has_permission($user_id, $permissions = [])
    {
        if (is_string($permissions)) {
            $permissions = explode('|', $permissions);
        }
        
        if (empty($permissions)) {
            return 0;
        }
        
        $userPermissions = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
        if (empty($userPermissions)) {
            return 0;
        }

        $has_permit = PermissionRole::where('role_id', $user_id)->whereIn('permission_id', $userPermissions)->exists();

        return $has_permit ? 1 : 0;
    }

    public static function admin_version()
    {
        $setting = Setting::where('id', '1')->first();
        return $setting->version;
    }
}