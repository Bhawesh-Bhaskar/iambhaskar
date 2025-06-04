<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomePage extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'home_pages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content1',
        'content2',
        'content3',
        'content4',
        'content5',
        'content6',
        'content7',
        'content8',
        'image1',
        'image2',
        'image3',
        'attachment1',
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
        // You can define any casting if needed
    ];

    /**
     * Get the full URL of the image1.
     *
     * @return string
     */
    public function getImage1UrlAttribute()
    {
        return asset('storage/' . $this->image1);
    }

    /**
     * Get the full URL of the image2.
     *
     * @return string
     */
    public function getImage2UrlAttribute()
    {
        return asset('storage/' . $this->image2);
    }

    /**
     * Get the full URL of the image3.
     *
     * @return string
     */
    public function getImage3UrlAttribute()
    {
        return asset('storage/' . $this->image3);
    }

    /**
     * Get the full URL of the attachment1.
     *
     * @return string
     */
    public function getAttachment1UrlAttribute()
    {
        return asset('storage/' . $this->attachment1);
    }
}
