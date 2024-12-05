<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Task;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Get the selected tab from the request (default to 'overview')
        $tab = $request->input('tab', 'overview');
        
        // Prepare general data to be passed to the view
        $data = [
            'totalCustomers' => Customer::count(),
            'totalTasks' => Task::count(),
            'completedTasks' => Task::where('status', 'completed')->count(),
            'totalChatMessages' => ChatMessage::count(),
            'recentCustomers' => Customer::latest()->take(5)->get(),
            'upcomingTasks' => Task::where('due_date', '>', now())->orderBy('due_date')->take(5)->get(),
            'customers' => Customer::paginate(10),
            'tasks' => Task::paginate(10),
            'chatMessages' => ChatMessage::latest()->take(20)->get(),
            'activeTab' => $tab,
        ];

        // Check if the user is an admin and include additional admin-specific data
        if (auth()->user()->isAdmin()) {
            $data['isAdmin'] = true; // Add a flag to determine if the user is an admin
            $data['totalUsers'] = User::count();  // Show the total number of users
            $data['users'] = User::paginate(10); // Paginate users list for admin
        } else {
            $data['isAdmin'] = false; // For regular users, add a flag indicating they aren't admins
        }

        return view('dashboard', $data);
    }
    public function adminIndex()
    {
        // Fetch necessary data for the admin dashboard
        $totalCustomers = User::count(); // Example: Total number of customers
        $totalTasks = Task::count(); // Example: Total number of tasks
        $completedTasks = Task::where('status', 'completed')->count(); // Example: Completed tasks
        $totalChatMessages = ChatMessage::count();
        $recentCustomers = User::latest()->take(5)->get(); // Get recent customers
        $upcomingTasks = Task::where('due_date', '>=', now())->orderBy('due_date')->take(5)->get(); // Get upcoming tasks

        // Return the admin dashboard view with data
        return view('admin.dashboard', compact(
            'totalCustomers', 
            'totalTasks', 
            'completedTasks', 
            'totalChatMessages', 
            'recentCustomers', 
            'upcomingTasks'
        ));
    }
}
