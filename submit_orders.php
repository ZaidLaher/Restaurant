<?php
// Database connection settings
$servername = "localhost";
$username = "root";  // Your MySQL username
$password = "";  // Your MySQL password
$dbname = "restaurant";  // Your database name

// Create the connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if (isset($_POST['submit'])) {
    // Get form data
    $table = $_POST['table'];
    $total_guests = $_POST['total-guests'];
    $starters = isset($_POST['starters']) ? implode(", ", $_POST['starters']) : '';
    $mains = isset($_POST['mains']) ? implode(", ", $_POST['mains']) : '';

    // Insert the order into the database
    $stmt = $conn->prepare("INSERT INTO orders (table_number, guests, starters, mains) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $table, $total_guests, $starters, $mains);



    if ($stmt->execute()) {
        echo "<p>Order submitted successfully for " . $table . ".</p>";
    } else {
        echo "<p>Error submitting order: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>

