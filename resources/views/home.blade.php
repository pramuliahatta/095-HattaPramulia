<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class=" flex flex-col justify-center items-center">

        @foreach ($posts as $post)
            <div class="max-w-screen-sm rounded overflow-hidden shadow-md bg-white m-3">
                <p class="p-3 pb-0">
                    {{ $post->title }}
                    <span class="text-xs text-gray-400">{{ $post->created_at->diffForHumans() }}</span>
                </p>
                <p class="p-3 pt-0 text-xs">{{ $post->user->username }}</p>
                <img class="w-full min-h-96 h-full border-y" src="/img/upload/{{ $post->photo }}" alt="CatPhoto">
                <p class="text-center p-5"><a href="/post/{{ $post->id }}"><i class="fa-regular fa-comment "></i>
                        Comment</a></p>
            </div>
        @endforeach

    </div>
</x-layout>

