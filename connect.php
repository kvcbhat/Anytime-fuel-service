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

// Form validation and submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $username = test_input($_POST["username"]);
    $email = test_input($_POST["email"]);
    $mobile = test_input($_POST["mobile"]);
    $password = test_input($_POST["password"]);
    $confirmpassword = test_input($_POST["confirmpassword"]);

    // Check if username or email already exists
    $sql = "SELECT * FROM register WHERE username='$username' OR email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Username or email already taken
        echo "Username or email already taken";
    } else {
        // Password confirmation
        if ($password != $confirmpassword) {
            echo "Passwords do not match";
        } else {
            // Insert user data into database
            $sql = "INSERT INTO register ( name, username, email, mobile, password) VALUES ('$name', '$username', '$email', '$mobile', '$password')";

            if ($conn->query($sql) === TRUE) {
                echo "Registration successful";
                header("Location: login.html");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
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