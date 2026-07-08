<?php
$conn = mysqli_connect('localhost', 'root', '', 'sondos');

if ($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = trim(strtolower($_POST['username']));
        $email = trim($_POST['email']);
        $password = MD5($_POST['password']);
        $confirmpassword = MD5($_POST['confirmpassword']);
        $role = $_POST['role']; // إضافة المتغير الجديد لاستقبال نوع الحساب

        
        $check = "SELECT * FROM users WHERE username='$name'";
        $q = mysqli_query($conn, $check);
        
        
        if ($q && mysqli_num_rows($q) > 0) {
            echo "اسم المستخدم غير متوفر (مُستخدم)";
        } else {
            if ($password == $confirmpassword) {
                // إضافة role إلى استعلام الإدخال
                $sql = "INSERT INTO users (username, email, password, role) VALUES ('$name', '$email', '$password', '$role')";
                $m = mysqli_query($conn, $sql);
                if ($m) {
                    header("Location: login.php");
                } else {
                    echo "خطأ في التسجيل";
                }
            } else {
                echo "كلمات المرور غير متطابقة";
            }
        }
    }
} else {
    echo "خطأ في الاتصال";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب - منصة فرصتك</title>
    <link rel="stylesheet" href="css/style.css">
    <style>

    </style>
</head>

<body>
    <section class="registration">
        <div class="registration-container">
            <h2>إنشاء حساب جديد</h2>
            <form action="signup.php" method="POST">
                <input type="text" name="username" placeholder="اسم المستخدم" required>
                <input type="email" name="email" placeholder="البريد الإلكتروني" required>
                <input type="password" name="password" placeholder="كلمة المرور" required>
                <input type="password" name="confirmpassword" placeholder="تأكيد كلمة المرور" required>
                
                <!-- إضافة قائمة منسدلة لتحديد الصلاحية (مطلوب في المشروع) -->
                <select name="role" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;">
                    <option value="" disabled selected>-- اختر نوع الحساب --</option>
                    <option value="seeker">باحث عن عمل</option>
                    <option value="employer">صاحب عمل / شركة</option>
                </select>

                <button type="submit">تسجيل</button>
                <a href="login.php" style="display: block; text-align: center; margin-top: 15px; color: #333; text-decoration: none;">لديك حساب بالفعل؟ تسجيل الدخول</a>
            </form>
        </div>
    </section>
</body>

</html>
