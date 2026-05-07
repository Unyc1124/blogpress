<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function search(Request $request)
{
    $query = $request->input('search');

    if(!$query){
        return redirect('/');
    }

    $blogs = Blog::with(['category', 'author', 'tags'])
        ->where('status', 'published')
        ->where(function($q) use ($query) {

            // match title
            $q->where('title', 'LIKE', '%' . $query . '%')

            // match category name
            ->orWhereHas('category', function($q) use ($query) {
                $q->where('name', 'LIKE', '%' . $query . '%');
            })

            // match tag name
            ->orWhereHas('tags', function($q) use ($query) {
                $q->where('name', 'LIKE', '%' . $query . '%');
            });

        })
        ->latest()
        ->paginate(9);

    return view('blogs.search', compact('blogs', 'query'));
}

 /*
    |--------------------------------------------------------------------------
    | AJAX FILTER (category + date)
    |--------------------------------------------------------------------------
    */

    public function filter(Request $request)
    {
        $category = $request->input('category');
        $date     = $request->input('date');

        $blogs = Blog::with(['category', 'author', 'tags'])
            ->where('status', 'published')
            ->when($category, function($q) use ($category) {
                $q->whereHas('category', function($q) use ($category) {
                    $q->where('slug', $category);
                });
            })
            ->when($date === 'oldest', function($q) {
                $q->oldest();
            })
            ->when($date === 'this_month', function($q) {
                $q->whereMonth('created_at', now()->month)
                  ->whereYear('created_at', now()->year);
            })
            ->when($date === 'this_year', function($q) {
                $q->whereYear('created_at', now()->year);
            })
            ->when(!$date || $date === 'latest', function($q) {
                $q->latest();
            })
            ->paginate(6);

        if($request->ajax()){
            return view('blogs.partials.blog-cards',
    compact('blogs'))->render();
        }

        return redirect('/');
    }
}