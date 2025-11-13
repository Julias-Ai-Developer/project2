<?php
class Student {
    private $pdo;
    public function __construct($pdo) { $this->pdo = $pdo; }

    public function addStudent($name,$email,$course) {
        $stmt = $this->pdo->prepare("INSERT INTO students(name,email,course) VALUES(?,?,?)");
        $stmt->execute([$name,$email,$course]);
    }

    public function getStudents() {
        return $this->pdo->query("SELECT * FROM students")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStudent($id,$name,$email,$course) {
        $stmt = $this->pdo->prepare("UPDATE students SET name=?,email=?,course=? WHERE id=?");
        $stmt->execute([$name,$email,$course,$id]);
    }

    public function deleteStudent($id) {
        $stmt = $this->pdo->prepare("DELETE FROM students WHERE id=?");
        $stmt->execute([$id]);
    }

    public function getStudent($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM students WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

// Database configuration
$password = "ceo@2005";  // Your actual password
$database = 'school_db'; // Database name

$pdo = new PDO("mysql:host=localhost;dbname=$database","root",$password);
$student = new Student($pdo);

$message = "";
$editMode = false;
$editData = null;

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $student->addStudent($_POST['name'], $_POST['email'], $_POST['course']);
        $message = "Student added successfully!";
    } elseif (isset($_POST['update'])) {
        $student->updateStudent($_POST['id'], $_POST['name'], $_POST['email'], $_POST['course']);
        $message = "Student updated successfully!";
    }
}

// Handle delete
if (isset($_GET['delete'])) {
    $student->deleteStudent($_GET['delete']);
    $message = "Student deleted successfully!";
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit();
}

// Handle edit
if (isset($_GET['edit'])) {
    $editMode = true;
    $editData = $student->getStudent($_GET['edit']);
}

$students = $student->getStudents();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
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
            max-width: 1200px;
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

        .content-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .form-card, .table-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 12px rgba(34, 139, 34, 0.1);
            border: 1px solid #d4edda;
        }

        .form-card h2, .table-card h2 {
            color: #1b4332;
            font-size: 1.5em;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #d8f3dc;
        }

        .success-message {
            background-color: #d8f3dc;
            color: #1b4332;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            border-left: 4px solid #40916c;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #2d6a4f;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.95em;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #d8f3dc;
            border-radius: 6px;
            font-size: 1em;
            transition: all 0.3s ease;
            background-color: #f8fdf9;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #52b788;
            box-shadow: 0 0 0 3px rgba(82, 183, 136, 0.1);
            background-color: white;
        }

        .btn {
            padding: 12px 25px;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.2s ease;
            cursor: pointer;
            border: none;
            font-size: 1em;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background-color: #40916c;
            color: white;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #2d6a4f;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(64, 145, 108, 0.3);
        }

        .btn-edit {
            background-color: #52b788;
            color: white;
            padding: 8px 15px;
            font-size: 0.9em;
        }

        .btn-edit:hover {
            background-color: #40916c;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
            padding: 8px 15px;
            font-size: 0.9em;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .btn-cancel {
            background-color: #6c757d;
            color: white;
            width: 100%;
            margin-top: 10px;
        }

        .btn-cancel:hover {
            background-color: #5a6268;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        thead {
            background-color: #2d6a4f;
            color: white;
        }

        th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.85em;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #e8f5e9;
            color: #2d6a4f;
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

        .actions {
            display: flex;
            gap: 10px;
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

        @media (max-width: 1024px) {
            .content-grid {
                grid-template-columns: 1fr;
            }

            .stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 1.6em;
            }

            .form-card, .table-card {
                padding: 20px;
            }

            table {
                font-size: 0.9em;
            }

            th, td {
                padding: 10px;
            }

            .actions {
                flex-direction: column;
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
            <p>Manage student records efficiently</p>
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

        <div class="content-grid">
            <div class="form-card">
                <h2><?= $editMode ? '✏️ Edit Student' : '➕ Add New Student' ?></h2>
                <form method="post">
                    <?php if ($editMode): ?>
                        <input type="hidden" name="id" value="<?= $editData['id'] ?>">
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="name">Student Name</label>
                        <input type="text" id="name" name="name" required 
                               value="<?= $editMode ? htmlspecialchars($editData['name']) : '' ?>"
                               placeholder="Enter full name">
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" required 
                               value="<?= $editMode ? htmlspecialchars($editData['email']) : '' ?>"
                               placeholder="Enter email">
                    </div>

                    <div class="form-group">
                        <label for="course">Course</label>
                        <input type="text" id="course" name="course" required 
                               value="<?= $editMode ? htmlspecialchars($editData['course']) : '' ?>"
                               placeholder="Enter course name">
                    </div>

                    <button type="submit" name="<?= $editMode ? 'update' : 'add' ?>" class="btn btn-primary">
                        <?= $editMode ? '💾 Update Student' : '➕ Add Student' ?>
                    </button>

                    <?php if ($editMode): ?>
                        <a href="<?= strtok($_SERVER['REQUEST_URI'], '?') ?>" class="btn btn-cancel">
                            ✖ Cancel
                        </a>
                    <?php endif; ?>
                </form>
            </div>

            <div class="table-card">
                <h2>📋 Student Records</h2>
                <?php if (count($students) > 0): ?>
                    <div style="overflow-x: auto;">
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
                                <?php foreach ($students as $s): ?>
                                    <tr>
                                        <td><strong>#<?= $s['id'] ?></strong></td>
                                        <td><?= htmlspecialchars($s['name']) ?></td>
                                        <td><?= htmlspecialchars($s['email']) ?></td>
                                        <td><?= htmlspecialchars($s['course']) ?></td>
                                        <td>
                                            <div class="actions">
                                                <a href="?edit=<?= $s['id'] ?>" class="btn btn-edit">✏️ Edit</a>
                                                <a href="?delete=<?= $s['id'] ?>" 
                                                   onclick="return confirm('Are you sure you want to delete this student?')" 
                                                   class="btn btn-delete">🗑️ Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="no-data">
                        No students found. Add your first student using the form.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>