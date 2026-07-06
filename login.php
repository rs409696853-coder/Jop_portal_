<?php
session_start();
require_once 'db.php';

// إذا كان المستخدم مسجلاً بالفعل، نوجهه حسب صلاحيته
if (isset($_SESSION['user_id'])) {
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
        header("Location: crud.php");
    } else {
        header("Location: jobs.php");
    }
    exit();
}

$error_msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        if ($password == $row['password'] || md5($password) == $row['password'] || password_verify($password, $row['password'])) {
            
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = isset($row['role']) ? $row['role'] : 'seeker';
            
            
            if ($_SESSION['role'] == 'admin') {
                header("Location: crud.php");
            } else {
                header("Location: jobs.php");
            }
            exit();
        } else {
            $error_msg = "كلمة المرور غير صحيحة!";
        }
    } else {
        $error_msg = "اسم المستخدم غير موجود!";
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول</title>
    <style>
        body { font-family: Tahoma, sans-serif; background-color: #f4f6f9; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); width: 300px; text-align: center; }
        input[type="text"], input[type="password"] { width: 90%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; }
        button { background: #3498db; color: white; border: none; padding: 10px 20px; width: 100%; border-radius: 4px; cursor: pointer; font-size: 16px; }
        button:hover { background: #2980b9; }
        .error { color: #e74c3c; font-weight: bold; margin-bottom: 15px; }
    </style>
</head>
<body>

    <div class="login-box">
        <h2>تسجيل الدخول</h2>
        
        <?php if ($error_msg != ""): ?>
            <div class="error"><?php echo $error_msg; ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <input type="text" name="username" placeholder="اسم المستخدم" required>
            <input type="password" name="password" placeholder="كلمة المرور" required>
            <button type="submit">دخول</button>
            <div style="margin-top: 20px; font-size: 14px;">
    ليس لديك حساب؟ 
    <a href="signup.php" style="color: #3498db; text-decoration: none; font-weight: bold;">إنشاء حساب جديد</a>
</div>
        </form>
    </div>

</body>
</html>