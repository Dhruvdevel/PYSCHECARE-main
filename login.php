<?php
session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate CSRF token
    if (empty($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        http_response_code(403);
        die("Invalid CSRF token.");
    }
    // Get user input
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate credentials (you should use a more secure method, e.g., database lookup)
    $validUsername = "example_user";
    $validPassword = "example_password";

    if ($username == $validUsername && $password == $validPassword) {
        // Successful login
        $_SESSION["username"] = $username;
        header("Location: welcome.php"); // Redirect to a welcome page
        exit();
    } else {
        // Invalid credentials
        echo "Invalid username or password";
    }
}
?>
