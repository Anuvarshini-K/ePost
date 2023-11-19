<!DOCTYPE html>
<html>
<head>
    <title>Register - Postman</title>
   <style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.box {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.box form {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.box label {
    margin-bottom: 5px;
}

.box input {
    padding: 8px;
    margin-bottom: 10px;
}

.box input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
}

.box input[type="submit"]:hover {
    background-color: #45a049;
}

.box a {
    text-decoration: none;
    color: #4CAF50;
}

.box a:hover {
    text-decoration: underline;
}

.popup {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ccc;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    z-index: 1000;
}

.overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 999;
}

   </style>
</head>
<body>
    <div class="box">
        <h2>Register for Postman</h2>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require_once('includes/db.php'); // Include the database connection script

            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password

            // You should validate and sanitize user inputs here.

            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $username, $password);

            if ($stmt->execute()) {
                echo "<div class='popup' id='successPopup'>";
                echo "Registration successful. You can now <a href='login.php'>login</a>.";
                echo "</div>";
                echo "<div class='overlay' id='overlay'></div>";
            } else {
                echo "Error: " . $conn->error;
            }
        }
        ?>

        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required><br>
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br>
            <br>
            <input type="submit" value="Register">
        </form>

        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>

    <script>
        // Show the success popup
        document.getElementById('successPopup').style.display = 'block';
        document.getElementById('overlay').style.display = 'block';

        // Close the popup when the overlay is clicked
        document.getElementById('overlay').addEventListener('click', function() {
            document.getElementById('successPopup').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        });
    </script>
</body>
</html>
