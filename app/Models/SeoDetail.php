<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SeoDetail extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'seo_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'seo_title',
        'seo_description',
        'seo_keywords',
        'canonical',
        'blog_seo_title',
        'blog_seo_description',
        'blog_seo_keywords',
        'blog_canonical',
        'status',
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
        'status' => 'boolean',  // Cast status as a boolean (0 = inactive, 1 = active)
    ];

    /**
     * Accessor for status to return readable status
     *
     * @return string
     */
    public function getStatusAttribute($value)
    {
        return $value ? 'Active' : 'Inactive';
    }
}
