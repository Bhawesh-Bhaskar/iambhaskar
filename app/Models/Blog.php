<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blogs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'category',
        'tag',
        'added_by',
        'image',
        'status',
        'credit',
        'credit_url',
        'featured',
        'orderby',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // You can hide any sensitive data if needed
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'fa_expiring' => 'datetime', // If you had a fa_expiring field
        'featured' => 'boolean',  // Ensures that `featured` is cast as a boolean
    ];

    /**
     * Get the user (admin) who added the blog.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    /**
     * You can add other relationships like categories and tags if they exist
     * and are modeled properly in other tables.
     */
    // Example relationship with a Category model:
    // public function category() {
    //     return $this->belongsTo(Category::class);
    // }

    // Example relationship with a Tag model (many-to-many):
    // public function tags() {
    //     return $this->belongsToMany(Tag::class);
    // }
}
