@extends('layouts.blog')

@section('title', $category->name)

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Category: {{ $category->name }}</h1>
            <p class="mt-2 text-lg text-gray-600">Browse all posts in this category</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($posts as $post)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500">No Image</span>
                        </div>
                    @endif
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <span>{{ $post->created_at->format('M d, Y') }}</span>
                            <span class="mx-2">&bull;</span>
                            <span>{{ $post->user->name }}</span>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ $post->title }}</h2>
                        <p class="text-gray-600 mb-4">{{ Str::limit(strip_tags($post->content), 100) }}</p>
                        <div class="flex flex-wrap mb-4">
                            @foreach($post->categories as $cat)
                                <a href="{{ route('blog.category', $cat->slug) }}" class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2 {{ $cat->id === $category->id ? 'bg-indigo-200 text-indigo-800' : '' }}">
                                    {{ $cat->name }}
                                </a>
                            @endforeach
                        </div>
                        <a href="{{ route('blog.post', $post->slug) }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                            Read more &rarr;
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <h3 class="text-lg font-medium text-gray-900">No posts found in this category</h3>
                    <p class="mt-2 text-gray-600">Check back later for new content.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
