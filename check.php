<?php
session_start();
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = mysqli_real_escape_string($conn, trim(strtolower($_POST['username'])));
    
   
    $password = md5($_POST['password']);
    
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role']; 
        
        if ($_SESSION['role'] == 'admin') {
            header("Location: admin.dashboard.php");
        } else {
            header("Location: jobs.php");
        }
        exit();
    } else {
        echo "<script>alert('اسم المستخدم أو كلمة المرور غير صحيحة'); window.location.href='login.php';</script>";
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>
