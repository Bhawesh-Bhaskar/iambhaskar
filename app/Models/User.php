<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Model
{
    use HasFactory, SoftDeletes, HasApiTokens;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_id',
        'phone',
        'email_verification_token',
        'image',
        'status',
        'email_verification',
        'phone_verification',
        'facebook_id',
        'google_id',
        'linkedin_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',   // Don't include password in model arrays
        'remember_token', // Don't include remember_token in model arrays
        'deleted_at', // Optionally hide the `deleted_at` column if not needed
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',  // Cast status as a boolean (1 = active, 0 = inactive)
        'email_verification' => 'boolean',
        'phone_verification' => 'boolean',
    ];

    /**
     * Get the user's full name (if applicable).
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * The user's associated roles (if applicable).
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);  // Assuming you have a `Role` model and many-to-many relationship
    }
}
