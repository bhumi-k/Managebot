<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\EmailVerificationRequest;
use App\Http\Controllers\{
    DashboardController,
    CustomerController,
    TaskController,
    ChatbotController,
    ProfileController,
    Auth\AuthenticatedSessionController,
    Auth\RegisteredUserController
};

// Public welcome page
Route::view('/', 'welcome')->name('welcome');

// Email Verification Routes
Route::get('/email/verify', function () {
    return view('auth.verify-email'); // Ensure you have this view file
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard'); // Change this redirect as needed
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Guest routes for login/register (provided by Breeze)
Route::middleware('guest')->group(function () {
    Route::get('login', function () {
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }
        return app(AuthenticatedSessionController::class)->create();
    })->name('login');
    
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    
    Route::get('register', function () {
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }
        return app(RegisteredUserController::class)->create();
    })->name('register');
    
    Route::post('register', [RegisteredUserController::class, 'store']);
});
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'adminIndex'])->name('admin.dashboard');
});


// Authenticated user routes
Route::middleware('auth')->group(function () {
    // Dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Resources
    Route::resource('customers', CustomerController::class);
    Route::resource('tasks', TaskController::class);
    Route::post('/chatbot', [ChatBotController::class, 'handleChat'])->name('chatbot.handle');
    Route::get('/tasks/pending', [TaskController::class, 'getPendingTasks'])->name('tasks.pending');
    Route::get('/tasks/today', [TaskController::class, 'getTasksForToday'])->name('tasks.today');
    // Chatbot routes
    Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot.index');
    Route::post('/chatbot/send-message', [ChatbotController::class, 'sendMessage'])->name('chatbot.sendMessage');
    Route::post('/chatbot/handle', [ChatbotController::class, 'handle'])->name('chatbot.handle');
    Route::get('/task/create', [ChatbotController::class, 'createTaskPage'])->name('task.create');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');

});



// Logout route
Route::post('logout', function () {
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    auth()->logout();
    return redirect('/');
})->name('logout')->middleware('auth');
