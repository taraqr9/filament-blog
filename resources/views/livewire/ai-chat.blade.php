<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<div class=" h-full flex flex-col max-w-lg mx-auto">
    <div class="p-4 text-white flex justify-center rounded-xl hover:bg-sky-950" style="background-color: #18181b">
        <span class="text-white  font-semibold tracking-wide">AI Assistant</span>
    </div>

    <div class="p-4 mt-2 rounded-xl" style="background-color: #18181b; height: 500px; overflow-y: auto;">
        <div class="flex flex-col space-y-2" id="chat-container"></div>
    </div>


    <div class="p-4 flex items-center mt-2 border-slate-200 rounded-xl gap-x-4" style="background-color: #18181b">
        <input id="chat-input" type="text" placeholder="Type your message..." class="flex-1 border border-slate-300 rounded-full px-4 py-2 focus:outline-none focus:ring focus:ring-indigo-300" style="color: black">
        <button type="button" id="send-btn" class="text-white rounded p-2 ml-2 bg-indigo-400 hover:bg-indigo-200 transition-colors">Send</button>

    </div>
</div>

@script
<script>
    const sendBtn = document.getElementById('send-btn');
    const chatInput = document.getElementById('chat-input');
    const chatContainer = document.getElementById('chat-container');

    sendBtn.addEventListener('click', async () => {
        const message = chatInput.value.trim();
        if (!message) return;

        chatContainer.insertAdjacentHTML('beforeend', `<div class="flex justify-end"><div class="bg-gray-600 text-white p-2 rounded-lg max-w-xs">${message}</div></div>`);
        chatInput.value = '';
        chatContainer.lastElementChild?.scrollIntoView({ behavior: 'smooth' });

        const loader = document.createElement('div');
        loader.className = 'flex';
        loader.innerHTML = '<div class="text-white p-2 rounded-lg max-w-xs italic">Thinking...</div>';
        chatContainer.appendChild(loader);
        chatContainer.lastElementChild?.scrollIntoView({ behavior: 'smooth' });

        try {
            const res = await fetch('/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ content: message })
            });
            const data = await res.json();
            loader.remove();
            chatContainer.insertAdjacentHTML('beforeend', `<div class="flex"><div class="text-white bg-slate-800 p-2 rounded-lg max-w-xs">${data.content[0].text}</div></div>`);
            chatContainer.lastElementChild?.scrollIntoView({ behavior: 'smooth' });
        } catch (e) {
            loader.remove();
            chatContainer.insertAdjacentHTML('beforeend', `<div class="flex"><div class="bg-red-200 text-white bg-slate-800 p-2 rounded-lg max-w-xs">Failed to get response.</div></div>`);
            chatContainer.lastElementChild?.scrollIntoView({ behavior: 'smooth' });
        }
    });

    chatInput.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            sendBtn.click();
        }
    });
</script>
@endscript
