<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <a href="{{ route('tasks.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to Tasks List
                        </a>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-700">Title</h3>
                        <p class="text-gray-900">{{ $task->title }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-700">Description</h3>
                        <p class="text-gray-900">{{ $task->description }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-700">Due Date</h3>
                        <p class="text-gray-900">{{ $task->due_date}}</p>
                    </div>
                  
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-700">Status</h3>
                        <p class="text-gray-900">{{ ucfirst($task->status) }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-700">Customer</h3>
                        <p class="text-gray-900">{{ $task->customer ? $task->customer->name : 'N/A' }}</p>
                    </div>

                    <div class="mt-6">
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('tasks.edit', $task) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Edit Task
                            </a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline-block mt-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this task?')">
                                    Delete Task
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
