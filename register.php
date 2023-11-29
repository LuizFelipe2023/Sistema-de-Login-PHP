<?php
require_once("connection/connect.php");
require_once("models/user.php");
require_once("dao/userDao.php");

$userDao = new UserDao($conn);

$registrationResultMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["username"]) || !isset($_POST["password"])) {
        $registrationResultMessage = "Please fill in both the username and password fields.";
    } else {
        $username = $_POST["username"];
        $password = $_POST["password"];
        try {
            $user = new User($username, $password);
            $registrationResult = $userDao->createUser($user);

            if ($registrationResult) {
                header("location: login.php");
                exit();
            } else {
                $registrationResultMessage = "Registration failed. Try Again";
            }
        } catch (PDOException $e) {
            $registrationResultMessage = "Error during registration: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registration</title>
</head>

<body>
    <div class="container">

        <h2>Registration</h2>

        <?php
        if (!empty($registrationResultMessage)) {
            echo "<p style='color: red;'>$registrationResultMessage</p>";
        }
        ?>

        <form action="register.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <button type="submit">Register</button>
        </form>

        <br>

        <a href="login.php">Login</a>

    </div>
</body>

</html>
