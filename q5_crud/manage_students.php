<?php
$pdo = new PDO("mysql:host=localhost;dbname=school_db", "root", "ceo@2005");

$message = "";

if (isset($_POST['add'])) {
    $stmt = $pdo->prepare("INSERT INTO students(name,email,course) VALUES(?,?,?)");
    $stmt->execute([$_POST['name'], $_POST['email'], $_POST['course']]);
    $message = "Student added successfully!";
}
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM students WHERE id=?");
    $stmt->execute([$_GET['delete']]);
    $message = "Student deleted successfully!";
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit();
}
if (isset($_POST['update'])) {
    $stmt = $pdo->prepare("UPDATE students SET name=?, email=?, course=? WHERE id=?");
    $stmt->execute([$_POST['name'], $_POST['email'], $_POST['course'], $_POST['id']]);
    $message = "Student updated successfully!";
}

$students = $pdo->query("SELECT * FROM students")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management - Inline Editing</title>
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
            max-width: 1400px;
            margin: 0 auto;
        }

        .header {
            background-color: #2d6a4f;
            padding: 40px;
            text-align: center;
            color: white;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 2px 12px rgba(34, 139, 34, 0.1);
        }

        .header h1 {
            font-size: 2.2em;
            margin-bottom: 8px;
        }

        .header p {
            font-size: 1em;
            color: #d8f3dc;
            opacity: 0.95;
        }

        .success-message {
            background-color: #d8f3dc;
            color: #1b4332;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            border-left: 4px solid #40916c;
            font-weight: 600;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .add-form-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 12px rgba(34, 139, 34, 0.1);
            border: 1px solid #d4edda;
        }

        .add-form-card h2 {
            color: #1b4332;
            font-size: 1.5em;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #d8f3dc;
        }

        .add-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            align-items: end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            color: #2d6a4f;
            font-weight: 600;
            margin-bottom: 6px;
            font-size: 0.9em;
        }

        .form-group input {
            padding: 10px 12px;
            border: 2px solid #d8f3dc;
            border-radius: 6px;
            font-size: 0.95em;
            transition: all 0.3s ease;
            background-color: #f8fdf9;
        }

        .form-group input:focus {
            outline: none;
            border-color: #52b788;
            box-shadow: 0 0 0 3px rgba(82, 183, 136, 0.1);
            background-color: white;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.2s ease;
            cursor: pointer;
            border: none;
            font-size: 0.95em;
            text-decoration: none;
            display: inline-block;
        }

        .btn-add {
            background-color: #40916c;
            color: white;
            padding: 12px 25px;
        }

        .btn-add:hover {
            background-color: #2d6a4f;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(64, 145, 108, 0.3);
        }

        .btn-update {
            background-color: #52b788;
            color: white;
            padding: 8px 16px;
            font-size: 0.85em;
        }

        .btn-update:hover {
            background-color: #40916c;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
            padding: 8px 16px;
            font-size: 0.85em;
            margin-left: 8px;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .table-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 12px rgba(34, 139, 34, 0.1);
            border: 1px solid #d4edda;
            overflow-x: auto;
        }

        .table-card h2 {
            color: #1b4332;
            font-size: 1.5em;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #d8f3dc;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            min-width: 800px;
        }

        thead {
            background-color: #2d6a4f;
            color: white;
        }

        th {
            padding: 15px 12px;
            text-align: left;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.85em;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #e8f5e9;
            vertical-align: middle;
        }

        tbody tr {
            transition: background-color 0.2s ease;
        }

        tbody tr:hover {
            background-color: #f8fdf9;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        td input[type="text"],
        td input[type="email"] {
            width: 100%;
            padding: 8px 10px;
            border: 2px solid #d8f3dc;
            border-radius: 4px;
            font-size: 0.9em;
            transition: all 0.3s ease;
            background-color: white;
        }

        td input[type="text"]:focus,
        td input[type="email"]:focus {
            outline: none;
            border-color: #52b788;
            box-shadow: 0 0 0 2px rgba(82, 183, 136, 0.1);
        }

        .id-column {
            font-weight: bold;
            color: #2d6a4f;
            width: 60px;
        }

        .action-column {
            white-space: nowrap;
            width: 200px;
        }

        .no-data {
            text-align: center;
            padding: 40px;
            color: #52b788;
            font-style: italic;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-box {
            background: white;
            padding: 25px;
            border-radius: 12px;
            border-left: 4px solid #52b788;
            box-shadow: 0 2px 12px rgba(34, 139, 34, 0.1);
        }

        .stat-box .label {
            color: #2d6a4f;
            font-size: 0.9em;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .stat-box .value {
            color: #1b4332;
            font-size: 2em;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 1.6em;
            }

            .add-form {
                grid-template-columns: 1fr;
            }

            .add-form-card,
            .table-card {
                padding: 20px;
            }

            .stats {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎓 Student Management System</h1>
            <p>Quick inline editing for efficient student record management</p>
        </div>

        <div class="stats">
            <div class="stat-box">
                <div class="label">Total Students</div>
                <div class="value"><?= count($students) ?></div>
            </div>
            <div class="stat-box">
                <div class="label">Active Records</div>
                <div class="value"><?= count($students) ?></div>
            </div>
        </div>

        <?php if ($message): ?>
            <div class="success-message">
                ✓ <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <div class="add-form-card">
            <h2>➕ Add New Student</h2>
            <form method="post" class="add-form">
                <div class="form-group">
                    <label for="name">Student Name</label>
                    <input type="text" id="name" name="name" required placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="course">Course</label>
                    <input type="text" id="course" name="course" required placeholder="Enter course">
                </div>
                <div class="form-group">
                    <label style="visibility: hidden;">Action</label>
                    <button type="submit" name="add" class="btn btn-add">➕ Add Student</button>
                </div>
            </form>
        </div>

        <div class="table-card">
            <h2>📋 All Students (Inline Editing)</h2>
            <?php if (count($students) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Course</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($students as $s): ?>
                        <tr>
                            <form method="post">
                                <td class="id-column">#<?= $s['id'] ?></td>
                                <td>
                                    <input type="text" name="name" value="<?= htmlspecialchars($s['name']) ?>" required>
                                </td>
                                <td>
                                    <input type="email" name="email" value="<?= htmlspecialchars($s['email']) ?>" required>
                                </td>
                                <td>
                                    <input type="text" name="course" value="<?= htmlspecialchars($s['course']) ?>" required>
                                </td>
                                <td class="action-column">
                                    <input type="hidden" name="id" value="<?= $s['id'] ?>">
                                    <button type="submit" name="update" class="btn btn-update">💾 Update</button>
                                    <a href="?delete=<?= $s['id'] ?>" 
                                       onclick="return confirm('Are you sure you want to delete this student?')" 
                                       class="btn btn-delete">🗑️ Delete</a>
                                </td>
                            </form>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="no-data">
                    📚 No students found. Add your first student using the form above.
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>