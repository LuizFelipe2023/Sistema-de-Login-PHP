<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Welcome</title>
</head>

<body>
    <div class="container">

        <h2>Welcome, <?php echo $username; ?>!</h2>
        <p>This is a simple greeting page. You are now logged in.</p>

        <p><a href="logout.php">Logout</a></p>

    </div>
</body>

</html>
