<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('TODO APP') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto mt-8 bg-white dark:bg-gray-800 shadow-md rounded-xl p-6">
        {{-- Add Task Form --}}
        <form action="{{ route('todos.search') }}" method="GET" class="flex gap-2 mb-6">

            <select name="month" class="border rounded-lg px-3 py-2 w-40">
                <option value="">Select Month</option>
                @foreach (range(1, 12) as $m)
                    <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                        {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                    </option>
                @endforeach
            </select>

            <select name="title_id" class="border rounded-lg px-3 py-2 w-40">
                <option value="">Select</option>
                @foreach ($titles as $title)
                    <option value="{{ $title->id }}" {{ request('title_id') == $title->id ? 'selected' : '' }}>
                        {{ $title->title }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                Search
            </button>
        </form>




        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 rounded-lg">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 border">Task</th>
                        <th class="px-4 py-2 border">Title</th>
                        <th class="px-4 py-2 border">Date</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach ($todos as $todo)
                        <tr class="text-white">
                            <td class="px-4 py-2 border">{{ $todo->description }}</td>
                            <td class="px-4 py-2 border">{{ $todo->title }}</td>
                            <td class="px-4 py-2 border">{{ $todo->created_at }}</td>

                        </tr>

        </div>
        @endforeach
        </tbody>
        </table>
        @include('components.edit-modal')

    </div>

    </div>


    {{-- Task List
        <ul class="space-y-3">
            @forelse ($todos as $todo)
                <li
                    class="flex justify-between items-center p-3 border rounded-lg {{ $todo->is_completed ? 'bg-green-100 line-through text-gray-500' : '' }}">
                    <span>{{ $todo->description }}</span>

                    <div class="flex gap-2">
                        @if (!$todo->is_completed)
                            <form action="{{ route('todos.update', $todo->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-sm">
                                    Complete
                                </button>
                            </form>
                        @endif

                        <form action="{{ route('todos.destroy', $todo->id) }}" method="POST"
                            onsubmit="return confirm('Delete this task?')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm">
                                Delete
                            </button>
                        </form>
                    </div>
                </li>
            @empty
                <li class="text-gray-500 text-center">No tasks yet.</li>
            @endforelse
        </ul> --}}
    </div>

    <script>
        function openEditModal(id, description) {
            // Show the modal
            document.getElementById('editModal').classList.remove('hidden');

            // Set the form action dynamically
            document.getElementById('editForm').action = '/todos/' + id;

            // Fill the input with current description
            document.getElementById('editDescription').value = description;
        }
    </script>

</x-app-layout>
