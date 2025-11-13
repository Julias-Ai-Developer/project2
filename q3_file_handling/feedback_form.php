<?php
$file = "feedback.txt";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $comment = trim($_POST["comment"]);
    if (!empty($name) && !empty($comment)) {
        $entry = "Name: $name\nComment: $comment\n---------------------\n";
        file_put_contents($file, $entry, FILE_APPEND);
        $success = "Thank you for your feedback!";
    }
}

$feedbacks = file_exists($file) ? file_get_contents($file) : "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
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
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        .header {
            background-color: #2d6a4f;
            padding: 40px;
            text-align: center;
            color: white;
            border-radius: 12px 12px 0 0;
            border: 1px solid #d4edda;
            border-bottom: none;
        }

        .header h2 {
            font-size: 2em;
            margin-bottom: 8px;
        }

        .header p {
            font-size: 1em;
            color: #d8f3dc;
            opacity: 0.95;
        }

        .feedback-form {
            background: white;
            padding: 40px;
            border: 1px solid #d4edda;
            border-top: none;
            border-bottom: none;
        }

        .success-message {
            background-color: #d8f3dc;
            color: #1b4332;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 25px;
            border-left: 4px solid #40916c;
            font-weight: 600;
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

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #d8f3dc;
            border-radius: 6px;
            font-size: 1em;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            transition: all 0.3s ease;
            background-color: #f8fdf9;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #52b788;
            box-shadow: 0 0 0 3px rgba(82, 183, 136, 0.1);
            background-color: white;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .btn-submit {
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

        .btn-submit:hover {
            background-color: #2d6a4f;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(64, 145, 108, 0.3);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .feedback-list {
            background: white;
            padding: 40px;
            border: 1px solid #d4edda;
            border-radius: 0 0 12px 12px;
        }

        .feedback-list h3 {
            color: #1b4332;
            font-size: 1.5em;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #d8f3dc;
        }

        .feedback-content {
            background-color: #f8fdf9;
            padding: 20px;
            border-radius: 6px;
            border-left: 4px solid #52b788;
            white-space: pre-wrap;
            word-wrap: break-word;
            color: #2d6a4f;
            line-height: 1.6;
            max-height: 400px;
            overflow-y: auto;
        }

        .no-feedback {
            text-align: center;
            color: #52b788;
            padding: 40px;
            font-style: italic;
        }

        @media (max-width: 768px) {
            .header {
                padding: 30px 20px;
            }

            .header h2 {
                font-size: 1.6em;
            }

            .feedback-form,
            .feedback-list {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>💬 Feedback Form</h2>
            <p>We'd love to hear your thoughts and suggestions</p>
        </div>

        <div class="feedback-form">
            <?php if (!empty($success)): ?>
                <div class="success-message">
                    ✓ <?php echo htmlspecialchars($success); ?>
                </div>
            <?php endif; ?>

            <form method="post">
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" required placeholder="Enter your name">
                </div>

                <div class="form-group">
                    <label for="comment">Your Feedback</label>
                    <textarea id="comment" name="comment" required placeholder="Share your thoughts with us..."></textarea>
                </div>

                <button type="submit" class="btn-submit">Submit Feedback</button>
            </form>
        </div>

        <div class="feedback-list">
            <h3>Previous Feedbacks</h3>
            <?php if (!empty($feedbacks)): ?>
                <div class="feedback-content"><?= htmlspecialchars($feedbacks) ?></div>
            <?php else: ?>
                <div class="no-feedback">No feedback yet. Be the first to share your thoughts!</div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>