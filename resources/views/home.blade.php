<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class=" flex flex-col justify-center items-center">

        @if (!is_null(request()->route()->parameter('user')))
            @if (request()->route()->named('post.index') &&
                    request()->route()->parameter('user')->username == Auth::user()->username)
                <a href="{{ route('post.create') }}" class="px-3 py-2 text-sm bg-blue-500 rounded text-white">
                    Create New Post
                </a>
            @endif
        @endif

        @foreach ($posts as $post)
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
                    <a href="{{ route('post.show', ['user' => $post->user->username, 'post' => $post->id]) }}">
                        {{ $post->title }}
                    </a>
                    <span class="text-xs text-gray-400">{{ $post->created_at->diffForHumans() }}</span>
                </p>
                <p class="p-3 pt-0 text-xs">
                    <a href="{{ route('post.index', ['user' => $post->user->username]) }}">
                        {{ $post->user->username }}
                    </a>
                </p>
                <img class="w-full min-h-96 h-full border-y" src="/img/upload/{{ $post->photo }}" alt="CatPhoto">
                <a href="{{ route('post.show', ['user' => $post->user->username, 'post' => $post->id]) }}">
                    <p class="text-center p-5 hover:bg-gray-300">
                        <i class="fa-regular fa-comment "></i>
                        Comment
                    </p>
                </a>
            </div>
        @endforeach

    </div>
</x-layout>

