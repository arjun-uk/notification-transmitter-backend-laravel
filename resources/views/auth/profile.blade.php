<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Realtime Chat</title>
    @include('chat.partials.styles')
    <style>
        .profile-container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .profile-avatar {
            width: 80px;
            height: 80px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 600;
            margin-right: 20px;
        }

        .profile-info h2 {
            margin: 0 0 8px 0;
            font-size: 1.5rem;
        }

        .profile-info p {
            margin: 0;
            color: var(--text-secondary);
        }

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: var(--text-secondary);
            text-decoration: none;
        }

        .back-link:hover {
            color: var(--primary-color);
        }

        .logout-btn {
            background-color: #ef4444;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }

        .logout-btn:hover {
            background-color: #dc2626;
        }
    </style>
</head>

<body>
    <div class="profile-container">
        <a href="{{ route('chat.index') }}" class="back-link">← Back to Chat</a>

        <div class="profile-header">
            <div class="profile-avatar">
                {{ substr($user->name, 0, 1) }}
            </div>
            <div class="profile-info">
                <h2>{{ $user->name }}</h2>
                <p>{{ $user->email }}</p>
                <p
                    style="margin-top: 8px; font-size: 0.875rem; background: #e0e7ff; color: #4338ca; padding: 4px 8px; border-radius: 4px; display: inline-block;">
                    Authenticated via Passport
                </p>
            </div>
        </div>

        <div style="border-top: 1px solid var(--border-color); padding-top: 20px;">
            <h3>Account Details</h3>
            <p><strong>Member since:</strong> {{ $user->created_at->format('F d, Y') }}</p>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</body>

</html>
