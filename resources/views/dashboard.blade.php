<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('TODO APP') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto mt-8 bg-white dark:bg-gray-800 shadow-md rounded-xl p-6">
        {{-- Add Task Form --}}
        <form action="{{ route('todos.store') }}" method="POST" class="flex gap-2 mb-6">
            @csrf
            <input type="text" name="description" placeholder="Enter task..."
                class="flex-1 border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300" required>
            <!-- Combo Box -->
            <select name="title_id" class="border rounded-lg px-3 py-2 w-40">
                <option value="">Select</option>
                @foreach ($titles as $title)
                    <option value="{{ $title->id }}">{{ $title->title }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                Add Task
            </button>
        </form>


        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 rounded-lg">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 border">Task</th>
                        <th class="px-4 py-2 border">Status</th>
                        <th class="px-4 py-2 border">Title</th>
                        <th class="px-4 py-2 border">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($todos as $todo)
                        <tr class="text-white">
                            <td class="px-4 py-2 border">{{ $todo->description }}</td>
                            <td class="px-4 py-2 border">{{ $todo->status }}</td>
                            <td class="px-4 py-2 border">{{ $todo->title }}</td>
                            <td class="px-4 py-2 border">
                                <div class="flex gap-2">
                                    <!-- Edit -->
                                    <button class="p-2 bg-blue-600 rounded text-white"
                                        onclick="openEditModal({{ $todo->id }}, '{{ $todo->description }}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" />
                                        </svg>
                                    </button>

                                    <!-- Delete -->
                                    <form action="{{ route('todos.destroy', $todo->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="p-2 bg-red-600 rounded text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-7 0h8l-1-3H9l-1 3z" />
                                            </svg>
                                        </button>
                                    </form>


                                    <!-- Completed -->
                                    <form action="{{ route('todos.update', $todo->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="p-2 bg-green-600 rounded text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
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
