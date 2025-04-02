<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm mb-6 flex justify-between w-full items-center p-3 rounded-md">
                <h3 class="text-lg font-semibold">
                    All Posts
                </h3>
                <a href="{{ route('admin.posts.create') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add New Post</a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th
                                class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                Title
                            </th>
                            <th
                                class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                Author
                            </th>
                            <th
                                class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                Categories
                            </th>
                            <th
                                class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                Status
                            </th>
                            <th
                                class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                Created At
                            </th>
                            <th
                                class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($posts as $post)
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    {{ $post->title }}
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    {{ $post->user->name }}
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    @foreach ($post->categories as $category)
                                        <span
                                            class="inline-block bg-gray-200 founded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2">
                                            {{ $category->name }}
                                        </span>
                                    @endforeach
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    @if ($post->is_published)
                                        <span
                                            class="inline-block bg-green-200 rounded-full px3 py-1 text-xs font-semibold text-green-700">
                                            Published
                                        </span>
                                    @else
                                        <span
                                            class="inline-block bg-yellow-200 rounded-full px-3 py-1 text-xs font-semibold text-yellow-700">Draft</span>
                                    @endif
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    {{ $post->created_at->format('M d, Y') }}
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.posts.edit', $post) }}"
                                            class="text-blue-500 hover:text-blue-700">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST"
                                            onsubmit="return confirm('Are you sure want to delete this post?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-4 border-b border-gray-200 text-center">
                                    No posts found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>
