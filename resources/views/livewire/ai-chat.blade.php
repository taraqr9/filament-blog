<div class="border-gray-500 h-screen flex flex-col max-w-lg mx-auto">
    <div class="bg-blue-500 p-4 text-white flex justify-between items-center">
        <button id="login" class="hover:bg-blue-400 rounded-md p-1">
            <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="6" r="4" stroke="#ffffff" stroke-width="1.5"></circle> <path d="M15 20.6151C14.0907 20.8619 13.0736 21 12 21C8.13401 21 5 19.2091 5 17C5 14.7909 8.13401 13 12 13C15.866 13 19 14.7909 19 17C19 17.3453 18.9234 17.6804 18.7795 18" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path></svg>
        </button>
        <span>Chat App</span>
        <div class="relative inline-block text-left">
            <button id="setting" class="hover:bg-blue-400 rounded-md p-1">
                <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.1395 12.0002C14.1395 13.1048 13.2664 14.0002 12.1895 14.0002C11.1125 14.0002 10.2395 13.1048 10.2395 12.0002C10.2395 10.8957 11.1125 10.0002 12.1895 10.0002C13.2664 10.0002 14.1395 10.8957 14.1395 12.0002Z" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M7.57381 18.1003L5.12169 12.8133C4.79277 12.2907 4.79277 11.6189 5.12169 11.0963L7.55821 5.89229C7.93118 5.32445 8.55898 4.98876 9.22644 5.00029H12.1895H15.1525C15.8199 4.98876 16.4477 5.32445 16.8207 5.89229L19.2524 11.0923C19.5813 11.6149 19.5813 12.2867 19.2524 12.8093L16.8051 18.1003C16.4324 18.674 15.8002 19.0133 15.1281 19.0003H9.24984C8.5781 19.013 7.94636 18.6737 7.57381 18.1003Z" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </button>
            <div id="dropdown-content" class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-lg shadow-lg p-2">
                <a href="#" class="flex items-center px-4 py-2 text-gray-800 hover:bg-gray-200 rounded-md">
                    Appearance
                </a>
                <a href="#" class="flex items-center px-4 py-2 text-gray-800 hover:bg-gray-200 rounded-md">
                    Favorite
                </a>
                <a href="#" class="flex items-center px-4 py-2 text-gray-800 hover:bg-gray-200 rounded-md">
                    More
                </a>
            </div>
        </div>
    </div>

    <div class="flex-1 overflow-y-auto p-4">
        <div class="flex flex-col space-y-2" id="chat-container">
            <!-- Dynamic messages will go here -->
        </div>
    </div>

    <div class="bg-white p-4 flex items-center">
        <input id="chat-input" type="text" placeholder="Type your message..." class="flex-1 border rounded-full px-4 py-2 focus:outline-none">
        <button id="send-btn" class="bg-blue-500 text-white rounded-full p-2 ml-2 hover:bg-blue-600 focus:outline-none">
            Send
        </button>
    </div>
</div>
@script
<script>
    const dropdownBtn = document.getElementById('setting');
    const dropdownMenu = document.getElementById('dropdown-content');
    const sendBtn = document.getElementById('send-btn');
    const chatInput = document.getElementById('chat-input');
    const chatContainer = document.getElementById('chat-container');

    // Toggle dropdown
    dropdownBtn.addEventListener('click', () => dropdownMenu.classList.toggle('hidden'));

    // Send message
    sendBtn.addEventListener('click', async () => {
        const message = chatInput.value.trim();
        if (!message) return;

        // Append user's message
        chatContainer.insertAdjacentHTML('beforeend', `<div class="flex justify-end"><div class="bg-blue-200 text-black p-2 rounded-lg max-w-xs">${message}</div></div>`);
        chatInput.value = '';

        // Append loading
        const loader = document.createElement('div');
        loader.className = 'flex';
        loader.innerHTML = '<div class="bg-gray-300 text-black p-2 rounded-lg max-w-xs italic">Typing...</div>';
        chatContainer.appendChild(loader);
        chatContainer.scrollTop = chatContainer.scrollHeight;

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
            chatContainer.insertAdjacentHTML('beforeend', `<div class="flex"><div class="bg-gray-300 text-black p-2 rounded-lg max-w-xs">${data.content[0].text}</div></div>`);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        } catch (e) {
            loader.remove();
            chatContainer.insertAdjacentHTML('beforeend', `<div class="flex"><div class="bg-red-200 text-black p-2 rounded-lg max-w-xs">Failed to get response.</div></div>`);
        }
    });
</script>

@endscript
