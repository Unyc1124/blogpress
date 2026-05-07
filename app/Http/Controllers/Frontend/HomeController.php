<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\Blog;

use App\Models\Category;

class HomeController extends Controller

{
    /*
    |--------------------------------------------------------------------------
    | HOME PAGE
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | HERO BLOG
        |--------------------------------------------------------------------------
        */

        $heroBlogs = Blog::where('status',
    'published')

    ->latest()

    ->take(5)

    ->get();

        /*
        |--------------------------------------------------------------------------
        | RECENT BLOGS
        |--------------------------------------------------------------------------
        */

        $blogs = Blog::where('status',
            'published')

            ->with([

                'category',
                'author'

            ])

            ->latest()

            ->paginate(6);

        $categories = Category::all();

        return view('frontend.home', compact(

            'heroBlogs',
            'blogs',
            'categories'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | BLOG DETAILS PAGE
    |--------------------------------------------------------------------------
    */

    public function show($slug)
    {
        $blog = Blog::with([

            'category',
            'author',
            'tags'

        ])

        ->where('slug', $slug)

        ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | RELATED BLOGS
        |--------------------------------------------------------------------------
        */

        $relatedBlogs = Blog::where(

            'category_id',
            $blog->category_id
        )

        ->where('id', '!=', $blog->id)

        ->latest()

        ->take(3)

        ->get();

        return view('frontend.blog-details',
            compact(

                'blog',
                'relatedBlogs'
            ));
    }
}