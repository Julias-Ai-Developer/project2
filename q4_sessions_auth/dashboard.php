<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin Panel</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        * {
            a {
                text-decoration: none;
            }
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f1f8f4;
            min-height: 100vh;
            padding: 20px;
        }

        .dashboard-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(34, 139, 34, 0.1);
            max-width: 900px;
            width: 100%;
            margin: 0 auto;
            overflow: hidden;
            border: 1px solid #d4edda;
        }

        .header {
            background-color: #2d6a4f;
            padding: 40px;
            color: white;
        }

        .header h2 {
            font-size: 2em;
            margin-bottom: 8px;
        }

        .header .subtitle {
            font-size: 1em;
            opacity: 0.95;
            color: #d8f3dc;
        }

        .content {
            padding: 40px;
            background-color: #f8fdf9;
        }

        .welcome-card {
            background-color: #d8f3dc;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 30px;
            border-left: 4px solid #40916c;
        }

        .welcome-card h3 {
            color: #1b4332;
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .welcome-card p {
            color: #2d6a4f;
            font-size: 1em;
            line-height: 1.6;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(64, 145, 108, 0.1);
            border-top: 3px solid #52b788;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(64, 145, 108, 0.2);
        }

        .stat-card h4 {
            color: #2d6a4f;
            font-size: 0.9em;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .stat-card .stat-value {
            font-size: 1.8em;
            font-weight: bold;
            color: #1b4332;
        }

        .actions {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn {
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
        }

        .btn-secondary {
            background-color: #52b788;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #40916c;
            transform: translateY(-2px);
        }

        .btn-logout {
            background-color: #b7e4c7;
            color: #1b4332;
            border: 2px solid #95d5b2;
        }

        .btn-logout:hover {
            background-color: #95d5b2;
            border-color: #74c69d;
            transform: translateY(-2px);
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: #52b788;
            font-size: 0.9em;
            border-top: 1px solid #d8f3dc;
            background-color: #f8fdf9;
        }

        @media (max-width: 768px) {
            .header h2 {
                font-size: 1.5em;
            }

            .content {
                padding: 20px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
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
    <div class="dashboard-container">
        <div class="header">
            <h2>Admin Dashboard</h2>
            <p class="subtitle">Welcome back, <?php echo htmlspecialchars($_SESSION['user']); ?>!</p>
        </div>

        <div class="content">
            <div class="welcome-card">
                <h3>Login Successful!</h3>
                <p>You have successfully logged into your admin panel. Manage your system from here.</p>
            </div>

            <div class="stats-grid">
                <a href="../bonus_oop/student_class.php">
                    <!-- <div class="stat-card">
                        <h4>Active Users</h4>
                        <div class="stat-value">1,234</div>
                    </div> -->
                    <div class="stat-card">
                        <h4>Student MS OOP</h4>
                        <div class="stat-value"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg></div>
                    </div>
                </a>

                <a href="../q1_fundamentals/student_marks.php">
                    <div class="stat-card">
                        <h4>Student Marks</h4>
                        <div class="stat-value"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg></div>
                    </div>
                </a>

                <div class="stat-card">
                    <h4>System Status</h4>
                    <div class="stat-value">Online</div>
                </div>
            </div>

            <!-- last ones -->
            <div class="stats-grid">
                <a href="../q5_crud/manage_students.php">
                    <div class="stat-card">
                        <h4>STUDENT MS</h4>
                        <div class="stat-value"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg> </div>
                    </div>
                </a>
                <a href="../q3_file_handling/feedback_form.php">
                    <div class="stat-card">
                        <h4>FeedBack Form</h4>
                        <div class="stat-value"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg></div>
                    </div>
                </a>
                <a href="../q2_forms_validation/register_user.php">
                    <div class="stat-card">
                        <h4>Register User</h4>
                        <div class="stat-value"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg></div>
                    </div>
                </a>
            </div>

            <div class="actions">
                <a href="#" class="btn btn-primary">Manage Users</a>
                <a href="#" class="btn btn-secondary">Settings</a>
                <a href="logout.php" class="btn btn-logout">Logout</a>
            </div>
        </div>

        <div class="footer">
            <p>&copy; 2024 Admin Panel. All rights reserved.</p>
        </div>
    </div>
</body>

</html>