<x-dashboard-layout>

    <h3 class="text-3xl font-medium text-gray-700">{{ $title }}</h3>

    <div class="flex flex-col mt-8">
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div
                class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Title</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Image Name</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Username</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                        </tr>
                    </thead>

                    <tbody class="bg-white">
                        @foreach ($posts as $post)
                            <tr>
                                <td
                                    class="px-6 py-4 text-sm leading-5 text-gray-700 whitespace-no-wrap border-b border-gray-200">
                                    {{ $post->title }}</td>
                                </td>

                                <td
                                    class="px-6 py-4 text-sm leading-5 text-gray-700 whitespace-no-wrap border-b border-gray-200">
                                    {{ $post->photo }}</td>
                                </td>

                                <td
                                    class="px-6 py-4 text-sm leading-5 text-gray-700 whitespace-no-wrap border-b border-gray-200">
                                    {{ $post->user->username }}</td>
                                </td>

                                <td
                                    class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-no-wrap border-b border-gray-200">
                                    {{-- <a href="#" class="text-red-600 hover:text-red-900">Edit</a> --}}
                                    <form action="{{ route('post.destroy', $post) }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button
                                            class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full text-red-600 hover:text-red-900"
                                            onclick="return confirm('Are you sure?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-dashboard-layout>
