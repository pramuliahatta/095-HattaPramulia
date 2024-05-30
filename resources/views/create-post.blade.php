<x-layout>

    <div class="bg-white p-7 rounded-3xl">

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-3"
                role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-3" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <h3 class="mb-4">Create New Post</h3>
        <hr class="mb-4">
        <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
                <input type="text" id="title" name="title"
                    class="bg-gray-50 border text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring-1 focus:ring-white focus:ring-offset-1 focus:ring-offset-gray-300 focus:border-gray-300 @error('title') border-red-500 @enderror"
                    placeholder="The Cutest Cat Ever" />
                @error('title')
                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-6" x-data="{ imageUrl: '', imagePreview: '' }">
                <!-- Input field for selecting image -->
                <label for="photo" class="block mb-2 text-sm font-medium text-gray-900">Photo</label>
                @error('photo')
                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                        {{ $message }}
                    </span>
                @enderror
                <input type="file" id="photo" name="photo" accept="image/*"
                    class="bg-gray-50 border text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring-1 focus:ring-white focus:ring-offset-1 focus:ring-offset-gray-300 focus:border-gray-300 @error('photo') border-red-500 @enderror"
                    @change="imageUrl = URL.createObjectURL($event.target.files[0])">

                <!-- Image preview container -->
                <div class="mt-4" x-show="imageUrl">
                    <h2 class="text-md mb-2">Photo Preview:</h2>
                    <img :src="imageUrl" alt="Image Preview" class="max-w-xs max-h-xs">
                </div>
            </div>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
    </div>
</x-layout>
