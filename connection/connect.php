<?php

$db_name = "login";
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_port = "3307";

try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name;port=$db_port", $db_user, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}
?>
