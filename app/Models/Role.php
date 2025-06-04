<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\PermissionRole;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'roles';
    
    protected $fillable = [
        'name',
        'display_name',
        'description',
        'user_type',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected $dates = ['deleted_at'];

    public static function permission_role($id)
    {
        return PermissionRole::where('role_id', $id)->pluck('permission_id');
    }
}
