<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class UserBlogController extends Controller
{
    /**
     * Display all published blogs (Frontend)
     */
    public function index()
    {
        $blogs = Blog::with('category')
            ->latest()
            ->paginate(6);

        $categories = Category::all();

        return view('blogs.index', compact('blogs', 'categories'));
    }

    /**
     * Display blog details along with related posts
     */
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();

        $relatedBlogs = Blog::where('category_id', $blog->category_id)
            ->where('id', '!=', $blog->id)
            ->latest()
            ->take(3)
            ->get();

        return view('blogs.details', compact('blog', 'relatedBlogs'));
    }


    /**
     * Display blogs filtered by a specific category
     */
    public function category(Category $category)
    {
        $blogs = Blog::where('category_id', $category->id)
            ->latest()
            ->paginate(6);

        $categories = Category::all();

        return view('blogs.index', [
            'blogs' => $blogs,
            'categories' => $categories,
            'selectedCategory' => $category,
        ]);
    }

    /**
     * Handle blog search functionality
     */
    public function search(Request $request)
    {
        $query = $request->input('q');

        $blogs = Blog::where('title', 'like', "%{$query}%")
            ->orWhere('content', 'like', "%{$query}%")
            ->latest()
            ->paginate(6);

        $categories = Category::all();

        return view('blogs.index', [
            'blogs' => $blogs,
            'categories' => $categories,
            'searchQuery' => $query,
        ]);
    }
}
