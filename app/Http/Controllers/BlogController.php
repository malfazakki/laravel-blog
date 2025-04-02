<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller {
    public function index() {
        $posts = Post::where('is_published', true)
            ->with(['user', 'categories'])
            ->latest()
            ->paginate(6);

        return view('blog.index', compact('posts'));
    }

    public function show($slug) {
        $post = Post::where('slug', $slug)
            ->where('is_published', true)
            ->with(['user', 'categories'])
            ->firstOrFail();

        return view('blog.show', compact('post'));
    }

    public function category($slug) {
        $category = Category::where('slug', $slug)->firstOrFail();

        $posts = $category->posts()
            ->where('is_published', true)
            ->with(['user', 'categories'])
            ->latest()
            ->paginate(6);

        return view('blog.category', compact('category', 'posts'));
    }
}
