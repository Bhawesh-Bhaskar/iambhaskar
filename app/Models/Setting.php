<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'logo',
        'favicon',
        'google_recaptcha_key',
        'google_recaptcha_secret',
        'google_analytics_code',
        'google_firebase_key',
        'version'
    ];
}