<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaintenanceSetting extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'maintenance_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject',
        'slug',
        'date',
        'from_time',
        'to_time',
        'message',
        'status',
    ];

    /**
     * Get the status of the maintenance setting.
     *
     * @return bool
     */
    public function getIsActiveAttribute()
    {
        return $this->status === 1;  // Return true if status is 1 (active)
    }
}
