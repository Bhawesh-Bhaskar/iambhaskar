<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Exception;
use App\Models\Backup;
use Illuminate\Support\Str;
use App\Http\Helpers\Common;

class BackupController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new Common();
    }

    public function index(Request $request)
    {
        $backups = Backup::orderBy('id', 'desc')->get();
        return view('admin.pages.setting.backup')->with(['title'=>'Database Backups', 'backups'=>$backups]);
    }

    public function store(Request $request)
    {
        $backup_name = $this->helper->backup_tables(env('DB_HOST'), env('DB_USERNAME'), env('DB_PASSWORD'), env('DB_DATABASE'));
        if ($backup_name != 0)
        {
            $rs = Backup::create([
                'name' => $backup_name,
                'created_by' => Auth::user()->id,
                'status' => 'completed',
            ]);
            
            $message = array('flag' => 'alert-success', 'message' => 'Backup Created Successfully');
            return redirect()->route('admin.backup.index')->with(['message' => $message]);  
        }else{
            $message = array('flag' => 'alert-danger', 'message' => 'Unable to Create Backup, Please try again');
            return redirect()->route('admin.backup.index')->with(['message' => $message]); 
        }
    }

    public function download(Request $request, $id)
    {
        $backup = Backup::find($id);
        if (!$backup) {
            $message = array('flag' => 'alert-danger', 'message' => 'Backup not found');
            return redirect()->route('admin.backup.index')->with(['message' => $message]); 
        }

        $filename = $backup->name;
        $backup_loc = public_path('assets/img/backups/' . $filename);
        if (!file_exists($backup_loc)) {
            $message = array('flag' => 'alert-danger', 'message' => 'File not found');
            return redirect()->route('admin.backup.index')->with(['message' => $message]);
        }

        return response()->download($backup_loc, $filename, [
            'Content-Type' => 'application/zip',
            'Cache-Control' => 'public',
            'Content-Description' => 'File Transfer',
            'Content-Transfer-Encoding' => 'binary',
        ]);
    }
}