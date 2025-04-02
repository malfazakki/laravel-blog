<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.posts.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Title --}}
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                required>
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- Title end --}}

                        {{-- Content --}}
                        <div class="mb-5">
                            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                            <textarea name="content" id="content" rows="10"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                required>
                                {{ old('content') }}
                            </textarea>
                        </div>
                        {{-- Content end --}}

                        {{-- Categories --}}
                        <div class="mb-4">
                            <label for="categories" class="block text-sm font-medium text-gray-700">
                                Categories
                            </label>
                            <select name="categories[]" id="categories"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                multiple required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categories')
                                <p class="text-ted-500 text-xs mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        {{-- Categories end --}}

                        {{-- Image --}}
                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700">Featured Image</label>
                            <input type="file" name="image" id="image" class="mt-1 block w-full">
                            @error('image')
                                <p class="text-red-500 text-xs mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        {{-- Image end --}}

                        {{-- Is Published --}}
                        <div class="mb-4">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="is_published"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    {{ old('is_publisehd') ? 'checked' : '' }}>
                                span.ml-2 <text-sm class="text-gray-600">Publish Immediately</text-sm>
                            </label>
                        </div>
                        {{-- Is Published end --}}

                        {{-- Button Cancel and Create --}}
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.posts.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 active:bg-gray-500 focus:border-gray-500 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 mr-2">Cancel</a>

                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue disabled:opacity-25 transition ease-in-out duration">
                                Create Post
                            </button>
                        </div>
                        {{-- Button Cancel and Create end --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
