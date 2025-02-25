<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #74ebd5, #acb6e5);
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 2rem;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            text-align: center;
        }

        h2 {
            margin-bottom: 1.5rem;
            color: #333;
            font-size: 1.8rem;
        }

        .form-group {
            margin-bottom: 1.2rem;
            text-align: left;
        }

        label {
            font-size: 0.9rem;
            color: #555;
        }

        input {
            width: 100%;
            padding: 0.8rem;
            margin-top: 0.5rem;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: border-color 0.3s ease;
        }

        input:focus {
            border-color: #74ebd5;
            outline: none;
            box-shadow: 0 0 8px rgba(116, 235, 213, 0.5);
        }

        button {
            width: 100%;
            padding: 0.8rem;
            font-size: 1rem;
            background: linear-gradient(135deg, #74ebd5, #acb6e5);
            border: none;
            color: #fff;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.6s ease;
        }
        
        button:hover {
            background: linear-gradient(135deg, #acb6e5, #74ebd5);
            transition: 0.6s ease;
        }

        .link {
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #555;
        }

        .link a {
            color: #74ebd5;
            text-decoration: none;
        }

        .link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="process_login.php" method="POST">
            <div class="form-group">
                <label for="email">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <p class="link">Don't have an account? <a href="register.html">Sign Up</a></p>
    </div>
</body>
</html>
