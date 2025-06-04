<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Exception;
use App\Models\Permission;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    public function index()
    {        
        $permissions = Permission::orderBy('created_at', 'desc')->get();
        return view('admin.pages.permission.index')->with(['title'=>'Permissions List', 'permissions'=>$permissions]);
    }
    
    public function create()
    {
        return view('admin.pages.permission.create')->with(['title' => 'Add Permission']);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'group' => 'required',
            'status' => 'required',
            'user_type' => 'required'
        ]);

        try {
            $user_type = $request->input('user_type');
            $status = $request->input('status');
            $group = $request->input('group');

            $permissions = ['view', 'add', 'edit', 'delete'];
            $messages = [];

            foreach ($permissions as $permission) {
                $display_name = ucfirst($permission) . ' ' . $group;
                $name = Str::slug($display_name);
                $description = $display_name;

                $permissionData = [
                    'group' => $group,
                    'name' => $name,
                    'display_name' => $display_name,
                    'description' => $description,
                    'user_type' => $user_type,
                    'status' => $status,
                ];

                $createdPermission = Permission::create($permissionData);

                if ($createdPermission) {
                    $messages[] = "$display_name permission created successfully.";
                } else {
                    $messages[] = "Failed to create $display_name permission.";
                }
            }

            $message = count($messages) === count($permissions)
                ? ['flag' => 'alert-success', 'message' => implode(' ', $messages)]
                : ['flag' => 'alert-danger', 'message' => implode(' ', $messages)];

            return redirect()->route('admin.permissions.index')->with(['message' => $message]);

        } catch (Exception $e) {
            $message = ['flag' => 'alert-danger', 'message' => 'Error: ' . $e->getMessage()];
            return back()->with(['message' => $message]);
        }
    }
}