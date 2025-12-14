<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Chat</title>
    @include('chat.partials.styles')
</head>

<body>

    <div class="chat-container">
        <div class="chat-header">
            <div class="header-left">
                <h1>Community Chat</h1>
                <span class="user-greeting">Hi, {{ auth()->user()->name }}</span>
            </div>
            <div class="header-right" style="display: flex; gap: 15px; align-items: center;">
                <div class="status-indicator">
                    <div class="status-dot"></div>
                    <span id="connection-status">Connecting...</span>
                </div>
                <a href="{{ route('profile') }}" class="profile-link">Profile</a>
            </div>
        </div>

        <div class="chat-messages" id="chat-messages">
            <!-- Messages will be loaded here -->
            <div style="text-align: center; color: #9ca3af; margin-top: 20px;">Welcome to the chat!</div>
        </div>

        <div class="chat-input-area">
            <input type="text" id="message-input" class="chat-input" placeholder="Type a message..."
                autocomplete="off">
            <button id="send-btn" class="send-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    style="display: block;">
                    <line x1="22" y1="2" x2="11" y2="13"></line>
                    <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                </svg>
            </button>
        </div>
    </div>

    @include('chat.partials.scripts')
</body>

</html>
