<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ChatBot') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Chat with ManageBot Pro</h3>
                <div id="chat-container" class="border border-gray-300 p-4 rounded h-64 overflow-y-auto">
                    <div id="chat-output"></div>
                </div>
                <form id="chat-form" class="mt-4 flex">
                    <input type="text" id="chat-input" class="border border-gray-300 rounded-l px-4 py-2 w-full" placeholder="Type a message...">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r">Send</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const chatForm = document.getElementById('chat-form');
        const chatInput = document.getElementById('chat-input');
        const chatOutput = document.getElementById('chat-output');

        chatForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            const userMessage = chatInput.value;
            chatOutput.innerHTML += `<div class="mb-2"><strong>You:</strong> ${userMessage}</div>`;
            chatInput.value = '';

            const response = await fetch('{{ route('chatbot.handle') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ query: userMessage })
            });

            const data = await response.json();
            chatOutput.innerHTML += `<div class="mb-2"><strong>Bot:</strong> ${data.response}</div>`;
            chatOutput.scrollTop = chatOutput.scrollHeight;
        });
    </script>
</x-app-layout>
