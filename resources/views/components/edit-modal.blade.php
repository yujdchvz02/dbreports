<div id="editModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-xl w-96">
        <h2 class="text-xl font-semibold mb-4">Edit Task</h2>

        <form id="editForm" method="POST" action="">
            @csrf
            @method('PUT')

            <input type="text" name="description" id="editDescription" class="w-full border p-2 rounded mb-4" required>
            <select name="title_id" class="border rounded-lg px-3 py-2 w-40">
                <option value="">Select</option>
                @foreach ($titles as $title)
                    <option value="{{ $title->id }}" {{ request('title_id') == $title->id ? 'selected' : '' }}>
                        {{ $title->title }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Save Changes
            </button>
        </form>

        <button class="mt-2 text-gray-600" onclick="document.getElementById('editModal').classList.add('hidden')">
            Cancel
        </button>
    </div>
</div>
