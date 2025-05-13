<?php

namespace Controller;

session_start(); // Start the session

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../model/user.php';

use Config\Database;
use Model\User;
use PDOException;

class LoginController
{
    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Sanitize and trim input data
            $formData = [
                'name' => trim($_POST['name'] ?? ''),
                'password' => $_POST['password'] ?? ''
            ];

            // Validate required fields
            if (empty($formData['name']) || empty($formData['password'])) {
                $msg = "Please fill in both fields.";
                echo "<script>
                    alert(" . json_encode($msg) . ");
                    window.location.href='../../frontend/html/page/login.html';
                </script>";
                exit();
            }

            try {
                // Create DB and User objects
                $db = new Database();
                $conn = $db->getConnection();
                $user = new User($conn);

                // Check if the name exists
                $userData = $user->getUserByName($formData['name']);  // Change to use 'name'
                if (!$userData) {
                    $msg = "❌ Invalid name or password.";
                    echo "<script>
                        alert(" . json_encode($msg) . ");
                        window.location.href='../../frontend/html/page/login.html';
                    </script>";
                    exit();
                }

                // Verify password
                if (password_verify($formData['password'], $userData['password'])) {
                    // Start session and store user info
                    $_SESSION['_id'] = $userData['id'];
                    $_SESSION['name'] = $userData['name'];  // Store name instead of email
                    $_SESSION['password'] = $userData['password'];

                    $msg = "✅ Login successful!";
                    echo "<script>
                        alert(" . json_encode($msg) . ");
                        window.location.href='../../frontend/html/page/sessions.php'; // or your desired page
                    </script>";
                    exit();
                } else {
                    $msg = "❌ Invalid name or password.";
                    echo "<script>
                        alert(" . json_encode($msg) . ");
                        window.location.href='../../frontend/html/page/login.html';
                    </script>";
                    exit();
                }
            } catch (PDOException $e) {
                $msg = "Database Error: " . $e->getMessage();
                echo "<script>
                    alert(" . json_encode($msg) . ");
                    window.location.href='../../frontend/html/page/login.html';
                </script>";
                exit();
            }
        } else {
            $msg = "Invalid request method.";
            echo "<script>
                alert(" . json_encode($msg) . ");
                window.location.href='../../frontend/html/page/login.html';
            </script>";
            exit();
        }
    }
}
