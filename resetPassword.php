<?php
session_start();
include_once("connection/connect.php");
include_once("dao/userDao.php");

$userDao = new UserDao($conn);
$resetMessage = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST["username"]) || !isset($_POST["new_password"])) {
        $resetMessage = "Fill in both the username and new password fields.";
    } else {
        $username = $_POST["username"];
        $newPassword = $_POST["new_password"];

        try {
            $resetResult = $userDao->resetPassword($username, $newPassword);

            if ($resetResult) {
                $resetMessage = "Password reset successful.";
            } else {
                $resetMessage = "Username not found or password reset failed.";
            }
        } catch (PDOException $e) {
            $resetMessage = "Error resetting password: " . $e->getMessage();
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
    <title>Password Reset</title>
</head>

<body>
    <div class="container">

        <h2>Password Reset</h2>

        <?php
        if (!empty($resetMessage)) {
            echo "<p style='color: " . ($resetResult ? "green" : "red") . ";'>$resetMessage</p>";
        }
        ?>

        <form action="resetPassword.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" required><br>

            <button type="submit">Reset Password</button>
        </form>

        <br>

        <a href="login.php">Back to Login</a>

    </div>
</body>

</html>
