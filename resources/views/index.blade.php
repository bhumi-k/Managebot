@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold mb-6">Tasks</h1>
    
    <div class="mb-6">
        <button class="bg-primary text-white px-4 py-2 rounded" onclick="toggleTaskForm()">Add New Task</button>
    </div>

    <div id="taskForm" class="bg-white rounded-lg shadow p-6 mb-6" style="display: none;">
        <h2 class="text-2xl font-semibold mb-4">Add New Task</h2>
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold mb-2">Title</label>
                <input type="text" name="title" id="title" class="w-full px-3 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
                <textarea name="description" id="description" rows="3" class="w-full px-3 py-2 border rounded" required></textarea>
            </div>
            <div class="mb-4">
                <label for="status" class="block text-gray-700 font-bold mb-2">Status</label>
                <select name="status" id="status" class="w-full px-3 py-2 border rounded" required>
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
            <button type="submit" class="bg-primary text-white px-4 py-2 rounded">Create Task</button>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($tasks as $task)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $task->title }}</td>
                        <td class="px-6 py-4">{{ Str::limit($task->description, 50) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($task->status == 'completed') bg-green-100 text-green-800
                                @elseif($task->status == 'in_progress') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($task->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="text-indigo-600 hover:text-indigo-900" onclick="editTask({{ $task->id }})">Edit</button>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ml-2 text-red-600 hover:text-red-900">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
function toggleTaskForm() {
    const form = document.getElementById('taskForm');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}

function editTask(taskId) {
    // Implement edit functionality (e.g., show a modal with a form to edit the task)
    console.log('Edit task:', taskId);
}
</script>
@endsection