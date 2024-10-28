<?php
// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "orders"; // Database name

    // Database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO contact2 (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    // Execute statement and check for success
    if ($stmt->execute()) {
        // Redirect to thank you page if insertion was successful
        header("Location: thank.html");
        exit();
    } else {
        // Display error message if something went wrong
        echo "There was an error saving your message. Please try again later.";
    }

    // Close connections
    $stmt->close();
    $conn->close();
} else {
    // Redirect to the form page if accessed without POST method
    header("Location: thank.html");
    exit();
}
?>