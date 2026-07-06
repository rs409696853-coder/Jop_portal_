<?php
// بدء الجلسة للوصول إليها
session_start();


session_unset();

session_destroy();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الخروج</title>
    <style>
        body { 
            font-family: Tahoma, sans-serif; 
            background-color: #f4f6f9; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0; 
        }
        .logout-box { 
            background: #fff; 
            padding: 40px; 
            border-radius: 8px; 
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); 
            text-align: center; 
            width: 350px; 
        }
        h2 { 
            color: #27ae60; 
            margin-bottom: 10px;
        }
        p { 
            font-size: 16px; 
            color: #555; 
            margin-bottom: 30px; 
        }
        .btn-login { 
            background: #3498db; 
            color: white; 
            padding: 12px 25px; 
            text-decoration: none; 
            border-radius: 5px; 
            font-weight: bold; 
            transition: 0.3s; 
            display: inline-block;
        }
        .btn-login:hover { 
            background: #2980b9; 
        }
    </style>
</head>
<body>

    <div class="logout-box">
        <h2>تم مسح الذاكرة بنجاح!</h2>
        <p>لقد تم تسجيل خروجك وتدمير الجلسة القديمة بأمان.</p>
        <a href="login.php" class="btn-login">الذهاب لصفحة تسجيل الدخول</a>
    </div>

</body>
</html>