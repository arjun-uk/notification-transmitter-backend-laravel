<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap');

    :root {
        --bg-color: #f3f4f6;
        --chat-bg: #ffffff;
        --primary-color: #4f46e5;
        --primary-hover: #4338ca;
        --text-color: #1f2937;
        --text-secondary: #6b7280;
        --message-bg-other: #f3f4f6;
        --message-bg-me: #4f46e5;
        --message-text-me: #ffffff;
        --border-color: #e5e7eb;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--bg-color);
        margin: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .chat-container {
        width: 100%;
        max-width: 600px;
        height: 90vh;
        background-color: var(--chat-bg);
        border-radius: 16px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .chat-header {
        padding: 20px;
        border-bottom: 1px solid var(--border-color);
        background-color: #fff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        z-index: 10;
    }

    .chat-header h1 {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-color);
    }

    .status-indicator {
        display: flex;
        align-items: center;
        font-size: 0.875rem;
        color: var(--text-secondary);
    }

    .status-dot {
        width: 8px;
        height: 8px;
        background-color: #10b981;
        border-radius: 50%;
        margin-right: 8px;
    }

    .chat-messages {
        flex: 1;
        padding: 20px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 12px;
        background: #fafafa;
    }

    .message {
        max-width: 75%;
        padding: 10px 16px;
        border-radius: 12px;
        font-size: 0.95rem;
        line-height: 1.5;
        position: relative;
        word-wrap: break-word;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .message.sender-other {
        background-color: var(--message-bg-other);
        color: var(--text-color);
        align-self: flex-start;
        border-bottom-left-radius: 4px;
    }

    .message.sender-me {
        background-color: var(--message-bg-me);
        color: var(--message-text-me);
        align-self: flex-end;
        border-bottom-right-radius: 4px;
    }

    .message .meta {
        font-size: 0.75rem;
        margin-top: 4px;
        opacity: 0.7;
        text-align: right;
    }

    .chat-input-area {
        padding: 20px;
        background-color: #fff;
        border-top: 1px solid var(--border-color);
        display: flex;
        gap: 12px;
    }

    .chat-input {
        flex: 1;
        padding: 12px 16px;
        border: 1px solid var(--border-color);
        border-radius: 24px;
        outline: none;
        font-family: inherit;
        font-size: 0.95rem;
        transition: border-color 0.2s;
    }

    .chat-input:focus {
        border-color: var(--primary-color);
    }

    .send-btn {
        background-color: var(--primary-color);
        color: white;
        border: none;
        padding: 0 20px;
        border-radius: 24px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .send-btn:hover {
        background-color: var(--primary-hover);
    }

    .profile-link {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 500;
        font-size: 0.9rem;
    }

    .profile-link:hover {
        text-decoration: underline;
    }

    .user-greeting {
        font-size: 0.85rem;
        color: var(--text-secondary);
        margin-top: 4px;
        display: block;
    }
</style>
