<?php
session_start();

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "afs";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get form data
  $CustomerId = $_SESSION["CustomerId"];
  // $customerId = $RegisterId;
  $fuelType = $_POST["fuelType"];
  $fuelAmount = $_POST["fuelAmount"];
  $deliveryAddress = $_POST["deliveryAddress"];

  // Calculate total amount based on fuel type
  if ($fuelType == "petrol") {
    $pricePerLitre = 120;
  } elseif ($fuelType == "diesel") {
    $pricePerLitre = 110;
  } else {
    $pricePerLitre = 0;
  }
  $totalAmount = $fuelAmount * $pricePerLitre;

  // Prepare and execute SQL statement to insert data into table
  $stmt = $conn->prepare("INSERT INTO orders (CustomerId , fuelType, fuelAmount, deliveryAddress, totalAmount) VALUES ( ?, ?, ?, ?, ?)");
 
  $stmt->bind_param("isisi", $CustomerId, $fuelType, $fuelAmount, $deliveryAddress, $totalAmount );
 
  if ($stmt->execute()) {
    // The query executed successfully
    echo "Order placed successfully!";
} else {
    // There was an error executing the query
    echo "Error placing order: " . $stmt->error;
}
 // Close statement and database connection
  $stmt->close();
  $conn->close();

  // Redirect user to thank-you page
  header("Location: thankspage.html");
  exit();
}
?>