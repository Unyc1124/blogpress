<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class BlogManagementController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | BLOG LIST
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $blogs = Blog::with([

            'category',
            'author'

        ])->latest()->get();

        return view(
            'admin.blogs.index',
            compact('blogs')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE PAGE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $categories = Category::all();

        return view(
            'admin.blogs.create',
            compact('categories')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE BLOG
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'title' => 'required|max:255',

            'content' => 'required',

            'status' => 'required',

            'author_name' => 'required|max:255',

            'featured_image' =>
                'nullable|image|mimes:jpg,jpeg,png'
        ]);

        /*
        |--------------------------------------------------------------------------
        | IMAGE UPLOAD TO CLOUDINARY
        |--------------------------------------------------------------------------
        */

        $imagePath = null;

        if ($request->hasFile(
            'featured_image'
        )) {

            $uploaded = Cloudinary::upload(

                $request->file('featured_image')
                         ->getRealPath(),

                ['folder' => 'blog_images']
            );

            $imagePath =
                $uploaded->getSecurePath();
        }

        /*
        |--------------------------------------------------------------------------
        | CREATE BLOG
        |--------------------------------------------------------------------------
        */

        $blog = Blog::create([

            'title' => $request->title,

            'slug' => Str::slug(
                $request->title
            ),

            'excerpt' => $request->excerpt,

            'content' => $request->content,

            'featured_image' => $imagePath,

            'category_id' =>
                $request->category_id,

            'author_id' => auth()->id(),

            'author_name' =>
                $request->author_name,

            'status' => $request->status,

            'published_at' =>

                $request->status ==
                'published'

                ? now()

                : null
        ]);

        /*
        |--------------------------------------------------------------------------
        | TAGS
        |--------------------------------------------------------------------------
        */

        if ($request->tags) {

            $tagNames = explode(

                ',',

                $request->tags
            );

            $tagIds = [];

            foreach ($tagNames as $tagName) {

                $tag = Tag::firstOrCreate([

                    'name' => trim($tagName),

                    'slug' => Str::slug(
                        trim($tagName)
                    )
                ]);

                $tagIds[] = $tag->id;
            }

            $blog->tags()
                ->attach($tagIds);
        }

        return redirect('/admin')

            ->with(

                'success',

                'Blog created successfully'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT BLOG PAGE
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $blog = Blog::with('tags')
            ->findOrFail($id);

        $categories = Category::all();

        return view(

            'admin.blogs.edit',

            compact(

                'blog',
                'categories'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE BLOG
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        $id
    ){

        $blog = Blog::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'title' => 'required|max:255',

            'content' => 'required',

            'status' => 'required',

            'author_name' => 'required|max:255',

            'featured_image' =>
                'nullable|image|mimes:jpg,jpeg,png'
        ]);

        /*
        |--------------------------------------------------------------------------
        | IMAGE UPDATE TO CLOUDINARY
        |--------------------------------------------------------------------------
        */

        $imagePath =
            $blog->featured_image;

        if ($request->hasFile(
            'featured_image'
        )) {

            $uploaded = Cloudinary::upload(

                $request->file('featured_image')
                         ->getRealPath(),

                ['folder' => 'blog_images']
            );

            $imagePath =
                $uploaded->getSecurePath();
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE BLOG
        |--------------------------------------------------------------------------
        */

        $blog->update([

            'title' => $request->title,

            'slug' => Str::slug(
                $request->title
            ),

            'author_name' =>
                $request->author_name,

            'excerpt' => $request->excerpt,

            'content' => $request->content,

            'featured_image' => $imagePath,

            'category_id' =>
                $request->category_id,

            'status' => $request->status,

            'published_at' =>

                $request->status ==
                'published'

                ? now()

                : null
        ]);

        /*
        |--------------------------------------------------------------------------
        | UPDATE TAGS
        |--------------------------------------------------------------------------
        */

        $tagIds = [];

        if ($request->tags) {

            $tagNames = explode(

                ',',

                $request->tags
            );

            foreach ($tagNames as $tagName) {

                $tag = Tag::firstOrCreate([

                    'name' => trim($tagName),

                    'slug' => Str::slug(
                        trim($tagName)
                    )
                ]);

                $tagIds[] = $tag->id;
            }
        }

        $blog->tags()
            ->sync($tagIds);

        return redirect('/admin')

            ->with(

                'success',

                'Blog updated successfully'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE BLOG
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | DELETE TAG RELATIONS
        |--------------------------------------------------------------------------
        */

        $blog->tags()->detach();

        /*
        |--------------------------------------------------------------------------
        | DELETE BLOG
        |--------------------------------------------------------------------------
        */

        $blog->delete();

        return redirect('/admin')

            ->with(

                'success',

                'Blog deleted successfully'
            );
    }
}