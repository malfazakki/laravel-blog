<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Welcome to your Blog Dashboard!</h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-blue-100 p-4 rounded shadow">
                            <h4 class="font-semibold">Posts</h4>
                            <p class="text-2xl font-bold">{{ \App\Models\Post::count() }}</p>
                            <a href="{{ route('admin.posts.index') }}" class="text-blue-500 hover:underline text-sm">Manage Posts →</a>
                        </div>

                        <div class="bg-green-100 p-4 rounded shadow">
                            <h4 class="font-semibold">Categories</h4>
                            <p class="text-2xl font-bold">{{ \App\Models\Category::count() }}</p>
                            <a href="{{ route('admin.categories.index') }}" class="text-green-500 hover:underline text-sm">Manage Categories →</a>
                        </div>

                        <div class="bg-purple-100 p-4 rounded shadow">
                            <h4 class="font-semibold">Users</h4>
                            <p class="text-2xl font-bold">{{ \App\Models\User::count() }}</p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h4 class="font-semibold mb-2">Recent Posts</h4>
                        <div class="bg-white rounded shadow">
                            <table class="min-w-full">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border-b text-left">Title</th>
                                        <th class="py-2 px-4 border-b text-left">Author</th>
                                        <th class="py-2 px-4 border-b text-left">Status</th>
                                        <th class="py-2 px-4 border-b text-left">Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(\App\Models\Post::with('user')->latest()->take(5)->get() as $post)
                                        <tr>
                                            <td class="py-2 px-4 border-b">{{ $post->title }}</td>
                                            <td class="py-2 px-4 border-b">{{ $post->user->name }}</td>
                                            <td class="py-2 px-4 border-b">
                                                @if($post->is_published)
                                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Published</span>
                                                @else
                                                    <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded">Draft</span>
                                                @endif
                                            </td>
                                            <td class="py-2 px-4 border-b">{{ $post->created_at->diffForHumans() }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="py-2 px-4 border-b text-center">No posts yet</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
