@extends('layouts.blog')

@section('title', $post->title)

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6">
            <a href="{{ route('home') }}" class="text-indigo-600 hover:text-indigo-800">&larr; Back to all posts</a>
        </div>

        <article class="bg-white rounded-lg shadow-md overflow-hidden">
            @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-64 object-cover">
            @endif

            <div class="p-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $post->title }}</h1>

                <div class="flex items-center text-sm text-gray-500 mb-6">
                    <span>{{ $post->created_at->format('M d, Y') }}</span>
                    <span class="mx-2">&bull;</span>
                    <span>By {{ $post->user->name }}</span>
                </div>

                <div class="flex flex-wrap mb-6">
                    @foreach($post->categories as $category)
                        <a href="{{ route('blog.category', $category->slug) }}" class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>

                <div class="prose max-w-none">
                    {!! $post->content !!}
                </div>
            </div>
        </article>
    </div>
@endsection
