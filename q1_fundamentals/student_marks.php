<?php
$students = [
    "John" => 85,
    "Mary" => 72,
    "Paul" => 64,
    "Grace" => 90,
    "Peter" => 55
];

function calculateGrade($mark) {
    if ($mark >= 80) return "A";
    elseif ($mark >= 70) return "B";
    elseif ($mark >= 60) return "C";
    elseif ($mark >= 50) return "D";
    else return "F";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Marks - Grading System</title>
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
            padding: 40px 20px;
        }

        .container {
            max-width: 800px;
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

        .table-container {
            background: white;
            padding: 40px;
            border: 1px solid #d4edda;
            border-radius: 0 0 12px 12px;
        }

        .stats-summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }

        .stat-box {
            background-color: #f8fdf9;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            border-left: 3px solid #52b788;
        }

        .stat-box .label {
            color: #2d6a4f;
            font-size: 0.85em;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .stat-box .value {
            color: #1b4332;
            font-size: 1.8em;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            overflow: hidden;
        }

        thead {
            background-color: #2d6a4f;
            color: white;
        }

        th {
            padding: 15px;
            text-align: center;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.9em;
        }

        td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #e8f5e9;
            color: #2d6a4f;
            font-size: 1em;
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

        .gradeA {
            background-color: #d8f3dc !important;
            font-weight: 600;
        }

        .gradeB {
            background-color: #e8f5e9;
        }

        .gradeC {
            background-color: #f1f8f4;
        }

        .gradeD {
            background-color: #fff3cd;
        }

        .gradeF {
            background-color: #f8d7da;
        }

        .grade-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.9em;
        }

        .badge-A {
            background-color: #40916c;
            color: white;
        }

        .badge-B {
            background-color: #52b788;
            color: white;
        }

        .badge-C {
            background-color: #74c69d;
            color: white;
        }

        .badge-D {
            background-color: #ffc107;
            color: #1b4332;
        }

        .badge-F {
            background-color: #dc3545;
            color: white;
        }

        .legend {
            margin-top: 30px;
            padding: 20px;
            background-color: #f8fdf9;
            border-radius: 8px;
            border-left: 4px solid #52b788;
        }

        .legend h3 {
            color: #1b4332;
            margin-bottom: 15px;
            font-size: 1.1em;
        }

        .legend-items {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #2d6a4f;
            font-size: 0.9em;
        }

        .legend-item span {
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .header {
                padding: 30px 20px;
            }

            .header h2 {
                font-size: 1.6em;
            }

            .table-container {
                padding: 20px;
                overflow-x: auto;
            }

            table {
                font-size: 0.9em;
            }

            th, td {
                padding: 10px;
            }

            .stats-summary {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>📊 Student Marks & Grades</h2>
            <p>Academic Performance Report</p>
        </div>

        <div class="table-container">
            <?php
            $total = count($students);
            $average = round(array_sum($students) / $total, 1);
            $highest = max($students);
            $lowest = min($students);
            ?>

            <div class="stats-summary">
                <div class="stat-box">
                    <div class="label">Total Students</div>
                    <div class="value"><?= $total ?></div>
                </div>
                <div class="stat-box">
                    <div class="label">Average Mark</div>
                    <div class="value"><?= $average ?></div>
                </div>
                <div class="stat-box">
                    <div class="label">Highest Mark</div>
                    <div class="value"><?= $highest ?></div>
                </div>
                <div class="stat-box">
                    <div class="label">Lowest Mark</div>
                    <div class="value"><?= $lowest ?></div>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Mark</th>
                        <th>Grade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $name => $mark): 
                        $grade = calculateGrade($mark);
                        $rowClass = "grade" . $grade;
                    ?>
                        <tr class="<?= $rowClass ?>">
                            <td><strong><?= htmlspecialchars($name) ?></strong></td>
                            <td><?= $mark ?></td>
                            <td>
                                <span class="grade-badge badge-<?= $grade ?>"><?= $grade ?></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="legend">
                <h3>Grading System</h3>
                <div class="legend-items">
                    <div class="legend-item">
                        <span class="grade-badge badge-A">A</span> 80-100
                    </div>
                    <div class="legend-item">
                        <span class="grade-badge badge-B">B</span> 70-79
                    </div>
                    <div class="legend-item">
                        <span class="grade-badge badge-C">C</span> 60-69
                    </div>
                    <div class="legend-item">
                        <span class="grade-badge badge-D">D</span> 50-59
                    </div>
                    <div class="legend-item">
                        <span class="grade-badge badge-F">F</span> Below 50
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>