<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class=" flex flex-col justify-center items-center">

        <div class="max-w-screen-sm rounded overflow-hidden shadow-md bg-white m-3">
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
                <form action="POST">
                    {{-- <p class="h-20 border rounded p-2">Write Comment Section Here --}}
                    <textarea id="message" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Write your thoughts here..." autofocus></textarea>
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
                        <button> <i class="fa-solid fa-trash m-auto text-red-500"></i>
                        </button>
                        {{-- <button> <i class="fa-solid fa-edit m-auto text-blue-500"></i>
                        </button> --}}
                        {{-- <button class="bg-red-500 hover:bg-red-700 text-white font-bold p-2 rounded">Delete</button> --}}

                    </div>
                @endforeach
            </div>

        </div>

    </div>
</x-layout>
