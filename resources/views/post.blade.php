<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class=" flex flex-col justify-center items-center">

        {{-- <a href="{{ URL::previous() }}" class="bg-blue-500 p-3 text-sm font-medium rounded text-white"> &larr; Back</a> --}}

        <div class="max-w-screen-sm rounded overflow-hidden shadow-md bg-white m-3">
            @if (Auth::id() == $post->user->id || Auth::user()->role == 'admin')
                <form action="{{ route('post.destroy', $post) }}" method="POST">
                    @method('delete')
                    @csrf
                    <button class="float-right m-5" onclick="return confirm('Are you sure?')"><i
                            class="fa-solid fa-trash m-auto text-red-500"></i></button>
                </form>
            @endif
            <p class="p-3 pb-0">
                {{ $post->title }}
                <span class="text-xs text-gray-400">{{ $post->created_at->diffForHumans() }}</span>
            </p>
            <p class="p-3 pt-0 text-xs">{{ $post->user->username }}</p>
            <img class="w-full min-h-96 h-full" src="/img/upload/{{ $post->photo }}" alt="CatPhoto">
            {{-- <img class="w-full min-h-96 h- border-y" src="/img/image.png" alt="CatPhoto"> --}}
            <p class="text-center p-5"><i class="fa-regular fa-comment "></i> {{ count($post->comment) }} Comments</p>

            {{-- Comment Section --}}
            <div class="p-5 border-t border-gray-300">
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 my-2 px-4 py-3 rounded relative"
                        role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 my-2 px-4 py-3 rounded relative"
                        role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif
                <form action="{{ route('comment.store') }}" method="POST">
                    @csrf
                    {{-- <p class="h-20 border rounded p-2">Write Comment Section Here --}}
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <textarea id="body" name="body" rows="4"
                        class="block p-2.5 w-full text-sm bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-1 focus:ring-white focus:ring-offset-1 focus:ring-offset-gray-300"
                        placeholder="Write your thoughts here..."></textarea>
                    </p>

                    <div class="my-3 flex items-end justify-end">
                        <button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Post</button>
                    </div>
                </form>

                @foreach ($post->comment as $comment)
                    <div class="p-2 hover:bg-gray-100 flex">

                        <div class="flex-1">
                            <p class="text-xs">
                                {{ $comment->user->username }}
                                <span class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                            </p>
                            <p class="mt-1 text-sm">{{ $comment->body }}</p>
                        </div>
                        @if (Auth::id() == $comment->user->id || Auth::user()->role == 'admin')
                            <form action="{{ route('comment.destroy', $comment) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button onclick="return confirm('Are you sure?')"> <i
                                        class="fa-solid fa-trash m-auto text-red-500"></i>
                                </button>
                            </form>
                        @endif
                        {{-- <button> <i class="fa-solid fa-edit m-auto text-blue-500"></i>
                        </button> --}}
                        {{-- <button class="bg-red-500 hover:bg-red-700 text-white font-bold p-2 rounded">Delete</button> --}}

                    </div>
                @endforeach
            </div>

        </div>

    </div>

    <script>
        @if (session('scroll_to_bottom'))
            window.scrollTo(0, document.body.scrollHeight);
        @endif
    </script>
</x-layout>
