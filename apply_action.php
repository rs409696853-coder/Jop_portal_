<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'db.php';

$user_id = null;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}

if (!$user_id) {
    die("<div style='text-align:center; margin-top:100px; font-family: Tahoma, sans-serif; direction: rtl;'>
            <h2 style='color:#e74c3c;'>عذراً، يجب تسجيل الدخول أولاً للتقديم على الوظائف.</h2>
            <br><br>
            <a href='login.php' style='padding:12px 25px; background:#3498db; color:white; text-decoration:none; border-radius:5px; font-size:16px;'>الذهاب لصفحة الدخول</a>
         </div>");
}

$job_id = isset($_GET['job_id']) ? intval($_GET['job_id']) : 0;

if ($job_id > 0) {
    $query = "INSERT INTO applications (seeker_id, job_id, status) VALUES ($user_id, $job_id, 'pending')";
    
    if (mysqli_query($conn, $query)) {
        session_unset();
        session_destroy();
        
        echo "<div style='text-align:center; margin-top:100px; font-family: Tahoma, sans-serif; direction: rtl;'>
                <h1 style='color:#27ae60;'>تم تقديم الطلب بنجاح! 🎉</h1>
                <p style='font-size:18px;'>تم إرسال طلبك للإدارة للمراجعة، <strong>وتم تسجيل خروجك لحماية حسابك</strong>.</p>
                <br><br>
                <a href='login.php' style='padding:12px 25px; background:#2c3e50; color:white; text-decoration:none; border-radius:5px; font-size:16px;'>الذهاب لصفحة تسجيل الدخول</a>
              </div>";
    } else {
        echo "<div style='text-align:center; margin-top:100px; font-family: Tahoma, sans-serif; direction: rtl;'>
                <h2 style='color:#e74c3c;'>حدث خطأ أثناء تقديم الطلب:</h2>
                <div style='background:#f8d7da; color:#721c24; padding:15px; width:60%; margin:auto; border-radius:5px; direction:ltr; text-align:left;'>
                    " . mysqli_error($conn) . "
                </div>
                <br><br>
                <a href='jobs.php' style='padding:12px 25px; background:#3498db; color:white; text-decoration:none; border-radius:5px;'>الرجوع والمحاولة مرة أخرى</a>
              </div>";
    }
} else {
    echo "<div style='text-align:center; margin-top:100px; font-family: Tahoma, sans-serif; direction: rtl;'>
            <h2 style='color:#e74c3c;'>خطأ: لم يتم تحديد الوظيفة بشكل صحيح.</h2>
            <br>
            <a href='jobs.php' style='padding:12px 25px; background:#3498db; color:white; text-decoration:none; border-radius:5px;'>الرجوع للوظائف</a>
          </div>";
}
?>
