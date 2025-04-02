<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $posts = Post::with('categories', 'user')->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'categories' => 'required|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean'
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->content = $request->content;
        $post->is_published = $request->has('is_published');
        $post->user_id = Auth::id();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . "." .
                $image->getClientOriginalExtension();
            $image->storeAs('public/posts', $imageName);
            $post->image = "posts/{$imageName}";
        }

        $post->save();
        $post->categories()->attach($request->categories);

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post) {
        $categories = Category::all();
        $selectedCategories = $post->categories->pluck('id')->toArray();
        return view('admin.posts.edit', compact('post', 'categories', 'selectedCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post) {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'categories' => "required|array",
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean'
        ]);

        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->content = $request->content;
        $post->is_published = $request->has('is_published');

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($post->image) {
                Storage::delete("public/{$post->image}");
            }

            $image = $request->file('image');
            $imageName = time() . "" .
                $image->getClientOriginalExtension();
            $image->storeAs('public/post', $imageName);
            $post->image = "posts/{$imageName}";
        }

        $post->save();
        $post->categories()->sync($request->categories);

        return redirect()->route('admin.posts.index')->with('success', "Post updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post) {
        // Delete image if exists
        if ($post->image) {
            Storage::delete("public/{$post->image}");
        }

        $post->categories()->detach();
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', "Post deleted successfully");
    }
}
