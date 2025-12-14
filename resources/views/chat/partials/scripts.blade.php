<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.16.1/dist/echo.iife.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.2/axios.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const messagesContainer = document.getElementById('chat-messages');
        const messageInput = document.getElementById('message-input');
        const sendBtn = document.getElementById('send-btn');
        const connectionStatus = document.getElementById('connection-status');

        // We can get the authenticated user from a global JS variable if we injected it, 
        // or just rely on the server to know who sent it.
        // For display purposes, we might want to know "my" name.
        const myName = "{{ auth()->user()->name }}";


        // Initialize Echo (Reverb Configuration)
        window.Echo = new Echo({
            broadcaster: 'reverb',
            key: 'local',
            wsHost: window.location.hostname,
            wsPort: 8080,
            wssPort: 8080,
            forceTLS: false,
            enabledTransports: ['ws', 'wss'],
        });

        // Monitor Connection
        window.Echo.connector.pusher.connection.bind('connected', () => {
            connectionStatus.innerText = 'Online';
            connectionStatus.style.color = '#10b981';
        });

        window.Echo.connector.pusher.connection.bind('failed', () => {
            connectionStatus.innerText = 'Disconnected';
            connectionStatus.style.color = '#ef4444';
        });

        // Subscribe to Channel
        window.Echo.channel('chat-room')
            .listen('.message.sent', (e) => {
                console.log('Message Received:', e);
                // Check if message is from me or others (simple check by name for now as we don't have auth IDs easily accessible without digging)
                // Actually, let's just append it. If we used ID we could distinguish better.
                // We will assume if sender_name == myName it's me? 
                // But realtime comes back to me too.
                appendMessage(e.message);
            });

        // Fetch Initial Messages
        axios.get('/messages')
            .then(response => {
                const messages = response.data;
                // Reverse if the API returns newest first (Repository was oldest(), so likely fine)
                // MessageRepository::oldest() returns oldest first (1, 2, 3).
                // So we just append them.
                messages.forEach(msg => appendMessage(msg));
                scrollToBottom();
            })
            .catch(error => console.error('Error fetching messages:', error));

        // Send Message
        function sendMessage() {
            const content = messageInput.value.trim();
            if (!content) return;

            const payload = {
                content: content
            };

            // Clear input immediately for better UX
            messageInput.value = '';

            axios.post('/messages', payload)
                .then(response => {
                    console.log('Message sent:', response.data);
                    // We don't append here because the event will come back to us via Echo
                    // However, for immediate feedback we COULD append, but we might get duplicates
                    // if we don't handle IDs. 
                    // Robust way: Append locally with a "sending" state?
                    // For simplicity, let's rely on Echo or just append and dedupe.
                    // Let's rely on Echo for "realtime" feel, or append and ignore the echo event if ID matches.
                    // But we don't have the ID until response.

                    // Let's just wait for Echo for now, it's fast enough on local Reverb.
                })
                .catch(error => {
                    console.error('Error sending message:', error);
                    alert('Failed to send message');
                });
        }

        sendBtn.addEventListener('click', sendMessage);
        messageInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') sendMessage();
        });

        function appendMessage(message) {
            const div = document.createElement('div');
            const isMe = message.sender_name === myName;

            div.classList.add('message');
            div.classList.add(isMe ? 'sender-me' : 'sender-other');

            const contentDiv = document.createElement('div');
            contentDiv.innerText = message.content;

            const metaDiv = document.createElement('div');
            metaDiv.classList.add('meta');
            // Simple time formatting
            const time = new Date(message.created_at).toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit'
            });
            metaDiv.innerText = (isMe ? 'You' : (message.sender_name || 'Anonymous')) + ' • ' + time;

            div.appendChild(contentDiv);
            div.appendChild(metaDiv);

            messagesContainer.appendChild(div);
            scrollToBottom();
        }

        function scrollToBottom() {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }
    });
</script>
