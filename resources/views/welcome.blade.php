<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-6">Welcome to ManageBot Pro</h1>
            <p class="text-gray-600 mb-8">Your one-stop solution for task management and chatbot functionality.</p>
            <div class="space-x-4">
                <a href="{{ route('login') }}" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Login
                </a>
                <a href="{{ route('register') }}" class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                    Register
                </a>
            </div>
        </div>
    </div>
</body>
</html>
