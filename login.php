<?php
// MySQL database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "afs";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start session
session_start();

// Form validation and submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);

    // Check if username and password are valid
    $sql = "SELECT * FROM register WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Username and password are valid, redirect to dashboard or homepage
        $row = $result->fetch_assoc();
        $_SESSION["CustomerId"] = $row["RegisterId"];
        header("Location: fp.html");
        exit;
    } else {
        // Username and password are not valid
        echo "Invalid username or password";
    }
    $conn->close();
}
// Input field data sanitization
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>