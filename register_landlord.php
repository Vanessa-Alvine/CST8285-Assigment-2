<?php
// Database connection details
$host = "localhost"; // Hostname or IP address of the database server
$username = "root"; // MySQL username
$password = ""; // MySQL password
$database = "appmanagement"; // Name of the database

// Establish a connection to the database
$conn = new mysqli($host, $username, $password, $database);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $name = $conn->real_escape_string($_POST["landlord_name"]);
    $email = $conn->real_escape_string($_POST["landlord_email"]);
    $phone = $conn->real_escape_string($_POST["phone"]);
    $password = $conn->real_escape_string($_POST["password"]);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Securely hash the password

    // SQL query to insert the data into the 'landlords' table
    $sql = "INSERT INTO landlords (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$hashed_password')";

    // Execute the query and check if the insertion was successful
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
