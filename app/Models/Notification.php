<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'notifications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'user_type',
        'notification_type',
        'description',
        'url_to_go',
        'read_status',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // You can add fields that you want to hide from arrays or JSON output
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'read_status' => 'boolean',  // Cast read_status to boolean
        'status' => 'boolean',       // Cast status to boolean (1 = active, 0 = inactive)
    ];

    /**
     * Get the user that owns the notification.
     */
    public function user()
    {
        return $this->morphTo();  // Assuming polymorphic relationship
    }
}
