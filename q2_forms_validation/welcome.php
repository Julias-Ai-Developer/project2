<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Registration Successful</title>
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
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .welcome-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(34, 139, 34, 0.1);
            max-width: 600px;
            width: 100%;
            overflow: hidden;
            border: 1px solid #d4edda;
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .welcome-header {
            background-color: #2d6a4f;
            padding: 40px;
            text-align: center;
            color: white;
        }

        .welcome-header .icon {
            width: 80px;
            height: 80px;
            background-color: #d8f3dc;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 3em;
        }

        .welcome-header h2 {
            font-size: 2em;
            margin-bottom: 8px;
        }

        .welcome-header p {
            font-size: 1em;
            color: #d8f3dc;
            opacity: 0.95;
        }

        .welcome-body {
            padding: 40px;
            background-color: #f8fdf9;
        }

        .success-banner {
            background-color: #d8f3dc;
            color: #1b4332;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            border-left: 4px solid #40916c;
            text-align: center;
            font-size: 1.1em;
            font-weight: 600;
        }

        .info-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
            border-left: 3px solid #52b788;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease;
        }

        .info-card:hover {
            transform: translateX(5px);
        }

        .info-card .label {
            color: #2d6a4f;
            font-weight: 600;
            font-size: 0.9em;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .info-card .value {
            color: #1b4332;
            font-size: 1.1em;
            word-wrap: break-word;
        }

        .actions {
            margin-top: 30px;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn {
            flex: 1;
            min-width: 150px;
            padding: 12px 25px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s ease;
            display: inline-block;
            text-align: center;
            cursor: pointer;
            border: none;
            font-size: 1em;
        }

        .btn-primary {
            background-color: #40916c;
            color: white;
        }

        .btn-primary:hover {
            background-color: #2d6a4f;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(64, 145, 108, 0.3);
        }

        .btn-secondary {
            background-color: #52b788;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #40916c;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(82, 183, 136, 0.3);
        }

        .welcome-footer {
            text-align: center;
            padding: 20px;
            color: #52b788;
            font-size: 0.9em;
            border-top: 1px solid #d8f3dc;
            background-color: white;
        }

        @media (max-width: 768px) {
            .welcome-header {
                padding: 30px 20px;
            }

            .welcome-header h2 {
                font-size: 1.6em;
            }

            .welcome-body {
                padding: 30px 20px;
            }

            .actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <div class="welcome-header">
            <div class="icon">✓</div>
            <h2>Registration Successful!</h2>
            <p>Your account has been created successfully</p>
        </div>

        <div class="welcome-body">
            <div class="success-banner">
                🎉 Welcome aboard! Your registration is complete.
            </div>

            <div class="info-card">
                <div class="label">Full Name</div>
                <div class="value"><?= htmlspecialchars($_GET['name'] ?? 'N/A') ?></div>
            </div>

            <div class="info-card">
                <div class="label">Email Address</div>
                <div class="value"><?= htmlspecialchars($_GET['email'] ?? 'N/A') ?></div>
            </div>

            <div class="info-card">
                <div class="label">Gender</div>
                <div class="value"><?= htmlspecialchars($_GET['gender'] ?? 'N/A') ?></div>
            </div>

            <div class="info-card">
                <div class="label">Hobbies</div>
                <div class="value"><?= htmlspecialchars($_GET['hobbies'] ?? 'None selected') ?></div>
            </div>

            <div class="actions">
                <a href="../q4_sessions_auth/login.php" class="btn btn-primary">Go to Login</a>
                <a href="../q4_sessions_auth/dashboard.php" class="btn btn-secondary">View Dashboard</a>
            </div>
        </div>

        <div class="welcome-footer">
            <p>&copy; 2024 Admin Panel. All rights reserved.</p>
        </div>
    </div>
</body>
</html>