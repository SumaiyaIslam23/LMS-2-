<?php
$connection = mysqli_connect("localhost", "root", "");
if (!$connection) {
    die("Database connection failed: " . mysqli_error($connection));
}

$db = mysqli_select_db($connection, "lms");
if (!$db) {
    die("Database selection failed: " . mysqli_error($connection));
}

// Validate and sanitize input
$name = mysqli_real_escape_string($connection, $_POST['name']);
$email = mysqli_real_escape_string($connection, $_POST['email']);
$password = mysqli_real_escape_string($connection, $_POST['password']);
$mobile = (int)$_POST['mobile']; // Assuming mobile is an integer
$address = mysqli_real_escape_string($connection, $_POST['address']);
$ID = (int)$_POST['ID']; // Assuming ID is an integer
$roll = mysqli_real_escape_string($connection, $_POST['roll']);

// Validate the name with a regular expression
if (!preg_match('/^[A-Za-z.-]+$/', $name)) {
    echo '<script type="text/javascript">alert("Invalid name. Please use only A-Z, a-z, ., and - characters."); window.location.href = "index.php";</script>';
    exit; // Exit the script
}

// Create a prepared statement
$query = "INSERT INTO users (name, email, password, mobile, address, status, ID, roll) VALUES (?, ?, ?, ?, ?, 0, ?, ?)";
$stmt = mysqli_prepare($connection, $query);

if ($stmt) {
    // Bind parameters
    mysqli_stmt_bind_param($stmt, 'sssisis', $name, $email, $password, $mobile, $address, $ID, $roll);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo '<script type="text/javascript">alert("Registration successful...You may login now!"); window.location.href = "index.php";</script>';
    } else {
        echo "Error: " . mysqli_error($connection);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    echo "Error in preparing the statement: " . mysqli_error($connection);
}

// Close the database connection
mysqli_close($connection);
?>
