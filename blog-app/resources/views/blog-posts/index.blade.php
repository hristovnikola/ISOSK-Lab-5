<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Blog Posts') }}
            </h2>
        </div>
    </x-slot>

    @if($allPosts->isEmpty())
        <p>No blog posts found.</p>
    @else
        <ul>
            @foreach($allPosts as $post)
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <li>
                                <div class="flex items-end">
                                    <h3 class="text-lg font-semibold">{{ $post->title }}</h3>
                                    <div class="flex space-x-4" style="margin-left: auto;">
                                        <span style="margin-right: 2rem">Author: {{ $post->writer->name}}</span>
                                        <button class="text-gray-800 rounded"
                                                onclick="toggleCommentForm({{ $post->id }})">
                                            Add Comment
                                        </button>
                                    </div>
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

                                <div id="commentForm{{ $post->id }}" class="hidden">
                                    <form action="{{ route('add-comment', ['id' => $post->id]) }}" method="POST">
                                        @csrf
                                        <div class="mb-2">
                                            <label for="commentBody" class="block text-sm font-medium text-gray-600">Comment:</label>
                                            <textarea id="commentBody" name="body" rows="2"
                                                      class="mt-1 p-2 border rounded-md w-full"></textarea>
                                        </div>
                                        <button type="submit"
                                                class="bg-green-500 text-gray-800 px-4 py-2 rounded focus:outline-none">
                                            Post Comment
                                        </button>
                                    </form>
                                </div>
                            </li>
                        </div>
                    </div>
                </div>
            @endforeach
        </ul>
    @endif

    <script>
        function toggleCommentForm(postId) {
            const commentForm = document.getElementById(`commentForm${postId}`);
            commentForm.classList.toggle('hidden');
        }
    </script>
</x-app-layout>
