<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Backup extends Model
{
    use HasFactory, SoftDeletes;

    // Define the table name if it's different from the default plural form
    protected $table = 'backups';

    // Define the primary key if it's not the default 'id'
    protected $primaryKey = 'id';

    // Define which fields are mass assignable
    protected $fillable = [
        'name',
        'created_by',
        'status',
    ];

    // Enable soft deletes
    protected $dates = ['deleted_at'];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
