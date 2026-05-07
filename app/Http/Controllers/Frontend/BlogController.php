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
}