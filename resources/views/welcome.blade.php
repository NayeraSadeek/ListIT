<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List It - Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
            background-color: #ffffff;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            background-color: #f8f9fa;
            max-width: 600px;
            width: 100%;
        }
        .welcome-text {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 600;
            color: #2c3e50;
            opacity: 0;
            animation: slideIn 0.8s ease-in-out forwards;
        }
        .title-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
        }
 

        #word1 {
            animation-delay: 0.3s;
            font-weight: 700;
        }
        #word2 {
            animation-delay: 1.1s;
            font-weight: 700;
        }
        #emoji {
            animation-delay: 1.1s;
            font-size: 2.5rem;
        }
        .description {
            text-align: center;
            font-size: 1.2rem;
            color: #34495e;
            margin-top: 1rem;
            opacity: 0;
            animation: slideIn 0.8s ease-in-out forwards;
            animation-delay: 1.9s;
        }
        .btn-container {
            margin-top: 1.5rem;
            opacity: 0;
            animation: slideIn 0.8s ease-in-out forwards;
            animation-delay: 2.7s;
        }
        .btn-primary, .btn-outline-primary {
            padding: 0.75rem 1.5rem;
            font-size: 1.1rem;
            border-radius: 10px;
        }
        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
        }
        .btn-outline-primary {
            border-color: #3498db;
            color: #3498db;
        }
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center">
        <div class="card">
            <div class="title-container">
                 <div class="welcome-text" id="word1">List</div>
                <div class="welcome-text" id="word2">It</div> 
                <div class="welcome-text" id="emoji">📋</div> 
            </div>
            <p class="description">
                Organize your day, boost your productivity, and achieve more with our simple yet powerful task management tool.
            </p>
            <div class="btn-container d-flex justify-content-center gap-3">
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                <a href="{{ route('register') }}" class="btn btn-outline-primary">Signup</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
