<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reverb Test</title>
</head>

<body>
    <h1>Reverb Test</h1>
    <p>Status: <span id="status">Connecting...</span></p>
    <ul id="messages"></ul>

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.16.1/dist/echo.iife.js"></script>

    <script>
        // Enable Pusher logging - don't use this in production
        Pusher.logToConsole = true;

        window.Echo = new Echo({
            broadcaster: 'reverb',
            key: 'local',
            wsHost: window.location.hostname,
            wsPort: 8080,
            wssPort: 8080,
            forceTLS: false,
            enabledTransports: ['ws', 'wss'],
        });

        document.getElementById('status').innerText = 'Initializing...';

        const channel = window.Echo.channel('chat-room');

        channel.listen('.message.sent', (e) => {
                console.log('Event received:', e);
                const li = document.createElement('li');
                li.innerText = JSON.stringify(e);
                document.getElementById('messages').appendChild(li);
            })
            .listen('message.sent', (e) => {
                console.log('Event received (no dot):', e);
            })
            .listen('MessageSent', (e) => {
                console.log('Event received (MessageSent):', e);
            });

        // Handle subscription success explicitly to avoid "No callbacks" warning
        channel.on('pusher:subscription_succeeded', () => {
            console.log('Subscription to chat-room succeeded!');
            const li = document.createElement('li');
            li.innerText = 'System: Subscribed to chat-room';
            li.style.color = 'green';
            document.getElementById('messages').appendChild(li);
        });

        window.Echo.connector.pusher.connection.bind('connected', () => {
            document.getElementById('status').innerText = 'Connected!';
            console.log('Connected to Reverb');
        });

        window.Echo.connector.pusher.connection.bind('failed', () => {
            document.getElementById('status').innerText = 'Connection Failed';
        });

        window.Echo.connector.pusher.connection.bind('unavailable', () => {
            document.getElementById('status').innerText = 'Connection Unavailable';
        });
    </script>
</body>

</html>
