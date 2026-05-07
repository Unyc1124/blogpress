<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [

        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'category_id',
        'author_id',
        'author_name',
        'status',
        'published_at',
        'meta_title',
        'meta_description'
    ];

    /*
    |--------------------------------------------------------------------------
    | CATEGORY RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /*
    |--------------------------------------------------------------------------
    | AUTHOR RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    public function author()
    {
        return $this->belongsTo(User::class,
            'author_id');
    }

    /*
    |--------------------------------------------------------------------------
    | TAGS RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}