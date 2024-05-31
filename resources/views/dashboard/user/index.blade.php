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
                                Name</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Email</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Username</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Status</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Role</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white">
                        @foreach ($users as $user)
                            <tr>
                                <td
                                    class="px-6 py-4 text-sm leading-5 text-gray-700 whitespace-no-wrap border-b border-gray-200">
                                    {{ $user->name }}</td>
                                </td>

                                <td
                                    class="px-6 py-4 text-sm leading-5 text-gray-700 whitespace-no-wrap border-b border-gray-200">
                                    {{ $user->email }}</td>
                                </td>

                                <td
                                    class="px-6 py-4 text-sm leading-5 text-gray-700 whitespace-no-wrap border-b border-gray-200">
                                    {{ $user->username }}</td>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    @if ($user->role == 'admin')
                                        <span
                                            class="inline-flex px-2 text-xs font-semibold leading-5 @if ($user->is_active) text-green-800 bg-green-100 @else text-red-800 bg-red-100 @endif rounded-full">{{ $user->is_active ? 'Active' : 'Inactive' }}</span>
                                    @else
                                        <form action="{{ route('dashboard.user.switch', $user) }}" method="POST">
                                            @method('put')
                                            @csrf
                                            <button
                                                class="inline-flex px-2 text-xs font-semibold leading-5 @if ($user->is_active) text-green-800 bg-green-100 @else text-red-800 bg-red-100 @endif rounded-full"
                                                onclick="return confirm('Change status to {{ !$user->is_active ? 'active' : 'inactive' }}?')">
                                                {{ $user->is_active ? 'Active' : 'Inactive' }}
                                            </button>
                                        </form>
                                    @endif
                                </td>

                                <td
                                    class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                    {{ $user->role }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-dashboard-layout>
