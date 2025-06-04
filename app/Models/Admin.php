<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Extend Authenticatable
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Authenticatable // Extend Authenticatable instead of Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'role_id', 
        'email', 
        'phone', 
        'image', 
        'password', 
        'status', 
        'fa_status', 
        'googlefa_secret', 
        'fa_expiring',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'googlefa_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'fa_expiring' => 'datetime',  // Cast `fa_expiring` as a date/time object
    ];

    /**
     * Get the role associated with the admin.
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * Get the password attribute and hash it before saving.
     */
    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = bcrypt($value); // Automatically hash the password
        }
    }
}
