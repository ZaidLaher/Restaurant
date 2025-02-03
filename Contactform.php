?php
// Database connection settings
$servername = "localhost";
$username = "root";  // Your MySQL username
$password = "";  // Your MySQL password
$dbname = "restaurant";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $message = $_POST['text'];

    // Validate form inputs
    if (empty($name) || empty($email) || empty($contact) || empty($message)) {
        echo "<p>Please fill in all the fields.</p>";
    } else {
        // Prepare SQL query to insert data into the database
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, contact_number, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $contact, $message);

        // Execute the query and check if the data was inserted successfully
        if ($stmt->execute()) {
            echo "<p>Thank you for your message, " . htmlspecialchars($name) . ". We will get back to you soon!</p>";
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>
