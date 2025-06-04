<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personal extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'personals';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email1',
        'email2',
        'phone1',
        'phone2',
        'whatsapp',
        'dob',
        'website',
        'age',
        'qualification',
        'location',
        'map',
        'freelance',
        'experience',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at',  // Optionally hide the `deleted_at` column
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'dob' => 'date',   // Cast `dob` to a date format
        'freelance' => 'boolean', // Cast `freelance` to a boolean
        'age' => 'integer',  // Cast `age` to an integer
    ];

    /**
     * Accessor for `dob` to calculate age.
     *
     * @return int
     */
    public function getAgeAttribute()
    {
        return \Carbon\Carbon::parse($this->dob)->age;
    }
}
