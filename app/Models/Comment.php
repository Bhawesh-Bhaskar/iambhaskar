<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'blog_id',
        'parent_id',
        'comment',
        'like',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',  // Ensures that the `status` is treated as a boolean (1 = active, 0 = inactive)
        'like' => 'integer',  // Casts `like` to an integer
    ];

    /**
     * Get the user who owns the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);  // Assuming you have a `User` model
    }

    /**
     * Get the blog that the comment is associated with.
     */
    public function blog()
    {
        return $this->belongsTo(Blog::class);  // Assuming you have a `Blog` model
    }

    /**
     * Get the parent comment (if any) for the current comment.
     */
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');  // Recursive relation to get the parent comment
    }

    /**
     * Get all the child comments (if any) for the current comment.
     */
    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id');  // Recursive relation to get all child comments
    }
}
