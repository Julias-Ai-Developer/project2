<?php
$name = $email = $password = $confirm = $gender = "";
$hobbies = [];
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm = $_POST["confirm"];
    $gender = $_POST["gender"] ?? "";
    $hobbies = $_POST["hobbies"] ?? [];

    if (empty($name) || empty($email) || empty($password) || empty($confirm))
        $errors[] = "All fields are required.";

    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $errors[] = "Invalid email format.";

    if ($password !== $confirm)
        $errors[] = "Passwords do not match.";

    if (empty($errors)) {
        header("Location: welcome.php?name=$name&email=$email&gender=$gender&hobbies=" . implode(",", $hobbies));
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
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

        .registration-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(34, 139, 34, 0.1);
            max-width: 600px;
            width: 100%;
            overflow: hidden;
            border: 1px solid #d4edda;
        }

        .registration-header {
            background-color: #2d6a4f;
            padding: 40px;
            text-align: center;
            color: white;
        }

        .registration-header h2 {
            font-size: 2em;
            margin-bottom: 8px;
        }

        .registration-header p {
            font-size: 0.95em;
            color: #d8f3dc;
            opacity: 0.95;
        }

        .registration-body {
            padding: 40px;
            background-color: #f8fdf9;
        }

        .error-messages {
            margin-bottom: 25px;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 10px;
            border-left: 4px solid #dc3545;
            font-size: 0.95em;
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

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #d8f3dc;
            border-radius: 6px;
            font-size: 1em;
            transition: all 0.3s ease;
            background-color: white;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="email"]:focus,
        .form-group input[type="password"]:focus {
            outline: none;
            border-color: #52b788;
            box-shadow: 0 0 0 3px rgba(82, 183, 136, 0.1);
        }

        .radio-group,
        .checkbox-group {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .radio-option,
        .checkbox-option {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .radio-option input[type="radio"],
        .checkbox-option input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #40916c;
        }

        .radio-option label,
        .checkbox-option label {
            color: #2d6a4f;
            font-weight: 500;
            cursor: pointer;
            margin: 0;
        }

        .btn-register {
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
            margin-top: 10px;
        }

        .btn-register:hover {
            background-color: #2d6a4f;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(64, 145, 108, 0.3);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .registration-footer {
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

        @media (max-width: 768px) {
            .registration-header {
                padding: 30px 20px;
            }

            .registration-header h2 {
                font-size: 1.6em;
            }

            .registration-body {
                padding: 30px 20px;
            }

            .radio-group,
            .checkbox-group {
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="registration-container">
        <div class="registration-header">
            <div class="icon">📝</div>
            <h2>User Registration</h2>
            <p>Create your account to get started</p>
        </div>

        <div class="registration-body">
            <?php if (!empty($errors)): ?>
                <div class="error-messages">
                    <?php foreach ($errors as $error): ?>
                        <div class="error-message">
                            ⚠ <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="post">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($name) ?>" placeholder="Enter your full name">
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" placeholder="Enter your email">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Create a password">
                </div>

                <div class="form-group">
                    <label for="confirm">Confirm Password</label>
                    <input type="password" id="confirm" name="confirm" placeholder="Confirm your password">
                </div>

                <div class="form-group">
                    <label>Gender</label>
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" id="male" name="gender" value="Male" <?= $gender === "Male" ? "checked" : "" ?>>
                            <label for="male">Male</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="female" name="gender" value="Female" <?= $gender === "Female" ? "checked" : "" ?>>
                            <label for="female">Female</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Hobbies</label>
                    <div class="checkbox-group">
                        <div class="checkbox-option">
                            <input type="checkbox" id="reading" name="hobbies[]" value="Reading" <?= in_array("Reading", $hobbies) ? "checked" : "" ?>>
                            <label for="reading">Reading</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" id="music" name="hobbies[]" value="Music" <?= in_array("Music", $hobbies) ? "checked" : "" ?>>
                            <label for="music">Music</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" id="sports" name="hobbies[]" value="Sports" <?= in_array("Sports", $hobbies) ? "checked" : "" ?>>
                            <label for="sports">Sports</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-register">Register</button>
            </form>
        </div>

        <div class="registration-footer">
            <p>Already have an account? <a href="../q4_sessions_auth/login.php" style="color: #40916c; font-weight: 600; text-decoration: none;">Login here</a></p>
        </div>
    </div>
</body>
</html>