<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once('includes/db.php'); // Include the database connection script

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate and sanitize user inputs here.

    $sql = "SELECT * FROM users WHERE username = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            // Successful login
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username']; // Set the username in the session
            header('Location: home.php'); // Redirect to the dashboard or home page
            exit();
        } else {
            echo "<p class='error-message'>Incorrect password. Please try again.</p>";
        }
    } else {
        echo "<p class='error-message'>User not found. Please register or check your username.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Postman</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    background-image: url("bg.png");
}

.box {
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.login-container {
    text-align: center;
}

.login-container form {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

a {
    text-decoration: none;
    color: #007BFF;
}

a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>
    <div class="box">
       

        <!-- Your existing HTML code for the login form -->
        <div class="login-container">
            <form action="" method="POST" >
                <h2>Login</h2>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <input type="submit" value="Login">
            </form>
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>
</body>
</html>
