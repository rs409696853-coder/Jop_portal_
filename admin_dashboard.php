<?php
session_start();

require_once 'db.php';

// 2. التأكد من تسجيل الدخول ومن صلاحية المدير
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("<div style='text-align:center; margin-top:50px; font-family:sans-serif;'>
            <h2 style='color:red;'>عذراً، هذه الصفحة خاصة بمدير الموقع فقط.</h2>
            <p>صلاحيات حسابك الحالي لا تسمح لك بالدخول لهذه الصفحة.</p>
            <a href='index.php' style='padding:10px 20px; background:#3498db; color:#fff; text-decoration:none; border-radius:5px;'>الرجوع للرئيسية</a>
         </div>");
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة تحكم المدير - منصة فرصتك</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .admin-container { width: 80%; margin: 50px auto; text-align: center; }
        .admin-box { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 30px; }
        .btn-card { padding: 30px; background: #3498db; color: white; border-radius: 10px; text-decoration: none; font-size: 1.2rem; transition: 0.3s; }
        .btn-card:hover { background: #2980b9; transform: scale(1.05); }
    </style>
</head>
<body>

<header class="header-sec">
    <div class="container">
        <div class="logo"><h3>لوحة الإدارة</h3></div>
        <nav>
            <ul>
                <li><a href="index.php">الرئيسية</a></li>
                <li><a href="logout.php" style="color: red;">تسجيل الخروج</a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="admin-container">
    <h2>أهلاً بك يا مدير، يمكنك التحكم في محتوى الموقع من هنا:</h2>
    
    <div class="admin-box">
    <!-- نرسل متغير section=jobs -->
    <a href="crud.php?section=jobs" class="btn-card">إضافة وظيفة جديدة</a>
    
    <!-- نرسل متغير section=users -->
    <a href="crud.php?section=users" class="btn-card">إدارة المستخدمين</a>
    
    <!-- نرسل متغير section=apps -->
    <a href="crud.php?section=apps" class="btn-card">طلبات التقديم</a>
</div>
</div>

<footer class="footer" style="margin-top: 100px;">
    <p>جميع الحقوق محفوظة - منصة فرصتك للتوظيف</p>
</footer>

</body>
</html>
