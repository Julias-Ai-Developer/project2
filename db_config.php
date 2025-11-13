
<?php
$servername = "localhost";
$username = "root";
$password = "ceo@2005";  // Your actual password
$database = 'php2_practical_test'; // Dat
// Create connection (OOP style)
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
} 


$conn->close();
?>
