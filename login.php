<?php
session_start();
include_once("connection/connect.php");
include_once("dao/userDao.php");

$userDao = new UserDao($conn);
$loginMessage = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST["username"]) || !isset($_POST["password"])) {
        $loginMessage = "Fill in all the fields!";
    } else {
        $username = $_POST["username"];
        $password = $_POST["password"];
        try {
            $stmt = $userDao->login($username, $password);

            if ($stmt) {
                $_SESSION["username"] = $username;
                header("Location: welcome.php");
                exit();
            } else {
                $loginMessage = "Invalid credentials. Please try again.";
            }
        } catch (PDOException $e) {
            $loginMessage = "Error during login: " . $e->getMessage();
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
    <title>Login</title>
</head>

<body>
    <div class="container">

        <h2>Login</h2>

        <?php
        if (!empty($loginMessage)) {
            echo "<p style='color: red;'>$loginMessage</p>";
        }
        ?>

        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <button type="submit">Login</button>
        </form>

        <br>

        <a href="register.php">Register</a>
        <a href="resetPassword.php">Reset password</a>

    </div>
</body>

</html>
