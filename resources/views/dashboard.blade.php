<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div x-data="{ activeTab: '{{ $activeTab }}' }">
                        <div class="mb-4 border-b border-gray-200">
                            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" role="tablist">
                                <li class="mr-2" role="presentation">
                                    <button class="inline-block p-4 rounded-t-lg" :class="{'text-blue-600 border-b-2 border-blue-600': activeTab === 'overview', 'hover:text-gray-600 hover:border-gray-300': activeTab !== 'overview'}" @click="activeTab = 'overview'" type="button" role="tab">Overview</button>
                                </li>
                                <li class="mr-2" role="presentation">
                                    <button class="inline-block p-4 rounded-t-lg" :class="{'text-blue-600 border-b-2 border-blue-600': activeTab === 'customers', 'hover:text-gray-600 hover:border-gray-300': activeTab !== 'customers'}" @click="activeTab = 'customers'" type="button" role="tab">Customers</button>
                                </li>
                                <li class="mr-2" role="presentation">
                                    <button class="inline-block p-4 rounded-t-lg" :class="{'text-blue-600 border-b-2 border-blue-600': activeTab === 'tasks', 'hover:text-gray-600 hover:border-gray-300': activeTab !== 'tasks'}" @click="activeTab = 'tasks'" type="button" role="tab">Tasks</button>
                                </li>
                                <li class="mr-2" role="presentation">
                                    <button class="inline-block p-4 rounded-t-lg" :class="{'text-blue-600 border-b-2 border-blue-600': activeTab === 'chatbot', 'hover:text-gray-600 hover:border-gray-300': activeTab !== 'chatbot'}" @click="activeTab = 'chatbot'" type="button" role="tab">Chatbot</button>
                                </li>
                                @if(auth()->user()->isAdmin())
                                    <li role="presentation">
                                        <button class="inline-block p-4 rounded-t-lg" :class="{'text-blue-600 border-b-2 border-blue-600': activeTab === 'admin', 'hover:text-gray-600 hover:border-gray-300': activeTab !== 'admin'}" @click="activeTab = 'admin'" type="button" role="tab">Admin</button>
                                    </li>
                                @endif
                            </ul>
                        </div>

                        <!-- Overview Tab -->
                        <div x-show="activeTab === 'overview'">
                            <h3 class="text-2xl font-bold mb-6 text-gray-800">Overview</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-6 rounded-lg shadow-lg text-white">
                                    <h4 class="text-lg font-semibold mb-2">Total Customers</h4>
                                    <p class="text-4xl font-bold">{{ $totalCustomers }}</p>
                                </div>
                                <div class="bg-gradient-to-br from-green-500 to-green-600 p-6 rounded-lg shadow-lg text-white">
                                    <h4 class="text-lg font-semibold mb-2">Total Tasks</h4>
                                    <p class="text-4xl font-bold">{{ $totalTasks }}</p>
                                </div>
                                <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 p-6 rounded-lg shadow-lg text-white">
                                    <h4 class="text-lg font-semibold mb-2">Completed Tasks</h4>
                                    <p class="text-4xl font-bold">{{ $completedTasks }}</p>
                                </div>
                                <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-6 rounded-lg shadow-lg text-white">
                                    <h4 class="text-lg font-semibold mb-2">Total Chat Messages</h4>
                                    <p class="text-4xl font-bold">{{ $totalChatMessages }}</p>
                                </div>
                            </div>

                            <!-- Recent Customers and Upcoming Tasks -->
                            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="bg-white p-6 rounded-lg shadow-md">
                                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Recent Customers</h3>
                                    <ul class="divide-y divide-gray-200">
                                        @foreach ($recentCustomers as $customer)
                                            <li class="py-3 flex items-center">
                                                <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">New</span>
                                                {{ $customer->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="bg-white p-6 rounded-lg shadow-md">
                                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Upcoming Tasks</h3>
                                    <ul class="divide-y divide-gray-200">
                                        @foreach ($upcomingTasks as $task)
                                            <li class="py-3 flex items-center justify-between">
                                                <span>{{ $task->title }}</span>
                                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ $task->due_date->format('M d, Y') }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Customers Tab -->
                        <div x-show="activeTab === 'customers'" class="mt-6">
                            <h3 class="text-2xl font-bold mb-6 text-gray-800">Customers</h3>
                            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($customers as $customer)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $customer->name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $customer->email }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $customer->created_at->format('M d, Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4">
                                {{ $customers->links() }}
                            </div>
                        </div>

                        <!-- Tasks Tab -->
                        <div x-show="activeTab === 'tasks'" class="mt-6">
                            <h3 class="text-2xl font-bold mb-6 text-gray-800">Tasks</h3>
                            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($tasks as $task)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $task->title }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $task->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                        {{ ucfirst($task->status) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
    @if($task->due_date)
        {{ $task->due_date->format('Y-m-d') }}
    @else
        Not Set
    @endif
</td>                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4">
                                {{ $tasks->links() }}
                            </div>
                        </div>

                        <!-- Chatbot Tab -->
                        <div x-show="activeTab === 'chatbot'" class="mt-6">
                            <h3 class="text-2xl font-bold mb-6 text-gray-800">Chatbot</h3>
                            <div class="bg-white p-6 rounded-lg shadow-md">
                                <p>Here you can interact with the chatbot for task management.</p>
                                <!-- Add Chatbot Component Here -->
                                <div class="mt-4">
                                    <!-- Example of Chatbot UI (replace with your own logic or chatbot system) -->
                                    <div id="chatbotContainer" class="bg-gray-100 p-4 rounded-lg shadow-md">
                                        <div class="chat-output space-y-2">
                                            <!-- Chatbot messages will go here -->
                                        </div>
                                        <input type="text" class="mt-4 p-2 w-full border border-gray-300 rounded-md" placeholder="Ask about your tasks...">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
