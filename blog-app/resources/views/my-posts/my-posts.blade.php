<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My Posts') }}
            </h2>
        </div>
    </x-slot>

    @if($posts->isEmpty())
        <p>No posts found.</p>
    @else
        <ul>
            @foreach($posts as $post)
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6"> {{-- Adjusted margin-bottom --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200 flex">
                            <li>
                                <div class="flex items-end">
                                    <h3 class="text-lg font-semibold">{{ $post->title }}</h3>
                                    <span class="ml-4">Author: {{ $post->writer->name }}</span>
                                </div>

                                <div>
                                    {{$post->body}}
                                </div>

                                <p><b>Comments:</b></p>
                                @if($post->comments->isNotEmpty())
                                    <ul>
                                        @foreach($post->comments as $comment)
                                            <li>
                                                {{ $comment->body }}
                                                - Commented by: {{ $comment->user->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>No comments yet.</p>
                                @endif
                            </li>
                            <div class="flex space-x-4" style="margin-left: auto; margin-top: auto">
                                <a style="margin-right: 2rem" href="{{ route('edit-post.edit', ['id' => $post->id]) }}">Edit</a>
                                <form method="post" action="{{ route('delete-post.delete', ['id' => $post->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </ul>
    @endif
</x-app-layout>
