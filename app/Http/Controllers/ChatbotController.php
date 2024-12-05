<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Mail;

class ChatbotController extends Controller
{
    /**
     * Display the chatbot page.
     */
    public function index()
    {
        return view('chatbot.index'); // Ensure you have a chatbot.index Blade view
    }

    /**
     * Handle the chatbot message.
     */
    public function sendMessage(Request $request)
    {
        $message = $request->input('message');
        $response = $this->generateBotResponse($message);

        return response()->json(['response' => $response]);
    }

    /**
     * Generate a bot response based on user message.
     */
    public function handle(Request $request)
    {
        $message = $request->input('query');
        $response = $this->generateBotResponse($message);

        // Return the response as JSON to the frontend
        return response()->json(['response' => $response]);
    }

    private function generateBotResponse($message)
    {
        // Handle different messages and commands
        if (str_contains(strtolower($message), 'hello') || str_contains(strtolower($message), 'hi')) {
            return "Hello! How can I assist you today? Please choose an option:<br>
                1. Create a Task<br>
                2. Report an Issue<br>
                3. General Query";
        } elseif (str_contains(strtolower($message), '1')) {
            return "Please provide the task details (e.g., title and description).";
        } elseif (str_contains(strtolower($message), '2')) {
            return "Please describe the issue you are facing.";
        } elseif (str_contains(strtolower($message), '3')) {
            return "Sure! Feel free to ask any general queries you have.";
        } elseif (str_contains(strtolower($message), 'create a task')) {
            // Create a task based on user input
            return $this->createTaskFromMessage($message);
        } elseif (str_contains(strtolower($message), 'update a task')) {
            // Update an existing task
            return $this->updateTaskFromMessage($message);
        } else {
            return "I'm sorry, I didn't understand that. Please select one of the options.";
        }
    }

    private function createTaskFromMessage($message)
    {
        // For simplicity, let's assume we extract a task title and description
        // In a real scenario, you'd want to parse this more intelligently
        $taskTitle = 'New Task from Chatbot';
        $taskDescription = $message;

        // Create the task in the database
        $task = Task::create([
            'title' => $taskTitle,
            'description' => $taskDescription,
            'status' => 'pending',
            'user_id' => auth()->id(),  // Assign the task to the logged-in user
        ]);

        // Send a notification to the admin
        $this->notifyAdmin("New task created: Task ID {$task->id} - {$taskTitle}");

        return "Task created successfully! Task ID: {$task->id}.";
    }

    private function updateTaskFromMessage($message)
    {
        // Logic to find and update the task based on user input
        // For simplicity, assume task ID is mentioned directly in the message
        preg_match('/task\s+(\d+)/i', $message, $matches);
        if (isset($matches[1])) {
            $taskId = $matches[1];
            $task = Task::find($taskId);

            if ($task) {
                // Update the task description or other fields as necessary
                $task->description = $message;  // Example: updating description
                $task->save();

                return "Task {$task->id} has been updated successfully.";
            } else {
                return "Task not found.";
            }
        }

        return "Please provide a valid task ID to update.";
    }

    private function notifyAdmin($message)
    {
        // Send an email to the admin
        Mail::raw($message, function ($mail) {
            $mail->to('kulkarnibhumika30@gmail.com')
                ->subject('New Chatbot Query or Task');
        });
    }
}
