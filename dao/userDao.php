<?php

require_once("models/user.php");

class UserDao implements UserDaoInterface
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createUser(User $user) {
        try {
            $username = $user->getUserName();
            $password = $user->getPassword();
            $options = ['cost' => 8];
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);
    
            $stmt = $this->conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bindValue(1, $username, PDO::PARAM_STR);
            $stmt->bindValue(2, $hashedPassword, PDO::PARAM_STR);
    
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error creating user: " . $e->getMessage());
        }
    }
    public function login($username, $password)
    {
        try {
            $stmt = $this->conn->prepare("SELECT password FROM users WHERE username = ?");
            $stmt->bindValue(1, $username, PDO::PARAM_STR);
            $stmt->execute();

            $hashedPassword = $stmt->fetchColumn();

            return $hashedPassword && password_verify($password, $hashedPassword);
        } catch (PDOException $e) {
            throw new Exception("Error during login: " . $e->getMessage());
        }
    }

    public function resetPassword($username, $newPassword)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->bindValue(1, $username, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $options = ['cost' => 8];
                $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT, $options);

                $updateStmt = $this->conn->prepare("UPDATE users SET password = ? WHERE username = ?");
                $updateStmt->bindValue(1, $hashedPassword, PDO::PARAM_STR);
                $updateStmt->bindValue(2, $username, PDO::PARAM_STR);

                return $updateStmt->execute();
            } else {
                return false;
            }
        } catch (PDOException $e) {
            throw new Exception("Error resetting password: " . $e->getMessage());
        }
    }
}
