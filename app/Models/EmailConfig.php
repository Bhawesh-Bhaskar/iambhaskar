<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailConfig extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'email_configs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email_protocol',
        'email_encryption',
        'smtp_host',
        'smtp_port',
        'smtp_email',
        'smtp_username',
        'smtp_password',
        'from_address',
        'from_name',
        'status',
        'notification_email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'smtp_password',  // Hide the SMTP password for security reasons
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',  // Cast the status to a boolean (1 = active, 0 = inactive)
    ];
}
