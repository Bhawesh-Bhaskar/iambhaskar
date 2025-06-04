<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Exception;
use App\Models\Permission;
use Illuminate\Support\Str;

class ErrorController extends Controller
{
    public function permissionDenied()
    {
        return view('errors.permission_denied');
    }

    public function underMaintenance()
    {
        $setting = session('setting');
        return view('errors.maintenance')->with(['setting' => $setting]);;
    }
}