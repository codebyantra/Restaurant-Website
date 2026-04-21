<?php
require_once 'config.php';

function register_user($full_name, $email, $password, $phone, $address) {
    global $conn;

    // 🔹 Check if email already exists
    $check_sql = "SELECT id FROM users WHERE email = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        return false; // email already exists
    }

    // 🔹 Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // 🔹 Insert user
    $sql = "INSERT INTO users (full_name, email, password, phone, address, role) 
            VALUES (?, ?, ?, ?, ?, 'user')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $full_name, $email, $hashed_password, $phone, $address);

    return $stmt->execute();
}


function login_user($email, $password) {
    global $conn;
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            $_SESSION['user_role'] = $user['role'];
            return $user;
        }
    }
    return false;
}

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function is_admin() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin';
}

function logout() {
    session_unset();
    session_destroy();
    header("Location: " . SITEURL . "login.php");
    exit();
}
?>
