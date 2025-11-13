<?php
include_once '../db_config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == "admin" && $password == "12345") {
        $_SESSION['user'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid login credentials!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin Panel</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f1f8f4;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(34, 139, 34, 0.1);
            max-width: 450px;
            width: 100%;
            overflow: hidden;
            border: 1px solid #d4edda;
        }

        .login-header {
            background-color: #2d6a4f;
            padding: 40px;
            text-align: center;
            color: white;
        }

        .login-header h2 {
            font-size: 2em;
            margin-bottom: 8px;
        }

        .login-header p {
            font-size: 0.95em;
            color: #d8f3dc;
            opacity: 0.95;
        }

        .login-body {
            padding: 40px;
            background-color: #f8fdf9;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            color: #2d6a4f;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.95em;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #d8f3dc;
            border-radius: 6px;
            font-size: 1em;
            transition: all 0.3s ease;
            background-color: white;
        }

        .form-group input:focus {
            outline: none;
            border-color: #52b788;
            box-shadow: 0 0 0 3px rgba(82, 183, 136, 0.1);
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background-color: #40916c;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-login:hover {
            background-color: #2d6a4f;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(64, 145, 108, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            border-left: 4px solid #dc3545;
            font-size: 0.95em;
        }

        .login-footer {
            text-align: center;
            padding: 20px;
            color: #52b788;
            font-size: 0.9em;
            border-top: 1px solid #d8f3dc;
            background-color: white;
        }

        .icon {
            width: 60px;
            height: 60px;
            background-color: #d8f3dc;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 2em;
        }

        @media (max-width: 480px) {
            .login-header {
                padding: 30px 20px;
            }

            .login-header h2 {
                font-size: 1.6em;
            }

            .login-body {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="icon">🔐</div>
            <h2>Admin Login</h2>
            <p>Enter your credentials to access the dashboard</p>
        </div>

        <div class="login-body">
            <?php if (!empty($error)): ?>
                <div class="error-message">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit" class="btn-login">Login</button>
            </form>
        </div>

        <div class="login-footer">
            <p>&copy; 2024 Admin Panel. All rights reserved.</p>
        </div>
    </div>
</body>
</html>