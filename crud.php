<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

require_once 'db.php';

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = intval($_GET['id']);
    if ($id > 0) {
        mysqli_query($conn, "DELETE FROM jobs WHERE job_id = $id");
    }
    header("Location: crud.php?section=jobs");
    exit();
}

if (isset($_GET['action']) && ($_GET['action'] == 'accept' || $_GET['action'] == 'reject')) {
    $s_id = intval($_GET['s_id']);
    $j_id = intval($_GET['j_id']);
    $status = ($_GET['action'] == 'accept') ? 'accepted' : 'rejected';
    
    if ($s_id > 0 && $j_id > 0) {
        mysqli_query($conn, "UPDATE applications SET status='$status' WHERE seeker_id=$s_id AND job_id=$j_id");
    }
    header("Location: crud.php?section=applications");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    
    if ($_POST['action'] == 'edit') {
        $id = intval($_POST['job_id']);
        mysqli_query($conn, "UPDATE jobs SET title='$title', description='$description' WHERE job_id=$id");
    } elseif ($_POST['action'] == 'add') {
        mysqli_query($conn, "INSERT INTO jobs (title, description) VALUES ('$title', '$description')");
    }
    
    header("Location: crud.php?section=jobs");
    exit();
}

$section = isset($_GET['section']) ? $_GET['section'] : 'jobs';
$action = isset($_GET['action']) ? $_GET['action'] : 'view';

?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة الإدارة</title>
    <style>
        body { font-family: Tahoma, sans-serif; background-color: #f4f6f9; margin: 0; display: flex; }
        .sidebar { width: 250px; background: #2c3e50; color: white; height: 100vh; padding: 20px 0; position: fixed; box-shadow: 2px 0 5px rgba(0,0,0,0.1); }
        .sidebar h2 { text-align: center; margin-bottom: 30px; border-bottom: 1px solid #34495e; padding-bottom: 15px; color: #3498db; }
        .sidebar a { display: block; color: white; text-decoration: none; padding: 15px 25px; font-size: 16px; transition: 0.3s; }
        .sidebar a:hover { background: #34495e; padding-right: 35px; }
        .content { margin-right: 250px; padding: 30px; width: 100%; box-sizing: border-box; }
        .header { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
        .header h3 { margin: 0; color: #333; }
        .btn-logout { background: #e74c3c; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; }
        .btn-logout:hover { background: #c0392b; }
        .main-box { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); min-height: 400px; overflow-x: auto; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: right; }
        th { background-color: #f8f9fa; color: #333; }
        tr:hover { background-color: #f1f1f1; }
        
        .btn-action { padding: 5px 10px; color: white; text-decoration: none; border-radius: 3px; font-size: 14px; margin-left: 5px; display: inline-block; }
        .btn-edit { background-color: #f39c12; }
        .btn-delete { background-color: #e74c3c; }
        .btn-accept { background-color: #27ae60; }
        .btn-add { background-color: #27ae60; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; font-weight: bold; display: inline-block; margin-bottom: 15px; }
        .btn-add:hover { background-color: #219150; }
        
        .edit-form label { display: block; margin-top: 15px; font-weight: bold; color: #2c3e50; }
        .edit-form input[type="text"], .edit-form textarea { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-family: Tahoma; }
        .edit-form button { margin-top: 20px; background: #2980b9; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-size: 16px; font-weight: bold; }
        .edit-form button:hover { background: #2471a3; }
        .btn-cancel { background: #95a5a6; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; display: inline-block; margin-right: 10px; }
        .btn-cancel:hover { background: #7f8c8d; }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>لوحة التحكم</h2>
        <a href="crud.php?section=jobs">💼 إدارة الوظائف</a>
        <a href="crud.php?section=applications">📄 طلبات التقديم</a>
    </div>

    <div class="content">
        <div class="header">
            <h3>مرحباً بك يا مدير النظام!</h3>
            <a href="logout.php" class="btn-logout">تسجيل الخروج</a>
        </div>

        <div class="main-box">
            <?php
            if ($action == 'add') {
                echo "<h2 style='color:#27ae60;'>إضافة وظيفة جديدة</h2>";
                echo "<hr style='border:1px solid #eee; margin-bottom:20px;'>";
                
                echo "<form method='POST' class='edit-form' action='crud.php'>";
                echo "<input type='hidden' name='action' value='add'>";
                
                echo "<label>عنوان الوظيفة:</label>";
                echo "<input type='text' name='title' required>";
                
                echo "<label>وصف الوظيفة:</label>";
                echo "<textarea name='description' rows='6' required></textarea>";
                
                echo "<div style='margin-top: 15px;'>";
                echo "<button type='submit'>إضافة الوظيفة</button>";
                echo "<a href='crud.php?section=jobs' class='btn-cancel'>إلغاء والرجوع</a>";
                echo "</div>";
                
                echo "</form>";
            }
            elseif ($action == 'edit') {
                $id = intval($_GET['id']);
                $result = mysqli_query($conn, "SELECT * FROM jobs WHERE job_id=$id");
                
                if (mysqli_num_rows($result) > 0) {
                    $job = mysqli_fetch_assoc($result);
                    echo "<h2 style='color:#f39c12;'>تعديل الوظيفة</h2>";
                    echo "<hr style='border:1px solid #eee; margin-bottom:20px;'>";
                    
                    echo "<form method='POST' class='edit-form' action='crud.php'>";
                    echo "<input type='hidden' name='action' value='edit'>";
                    echo "<input type='hidden' name='job_id' value='" . $job['job_id'] . "'>";
                    
                    echo "<label>عنوان الوظيفة:</label>";
                    echo "<input type='text' name='title' value='" . htmlspecialchars($job['title']) . "' required>";
                    
                    echo "<label>وصف الوظيفة:</label>";
                    echo "<textarea name='description' rows='6' required>" . htmlspecialchars($job['description']) . "</textarea>";
                    
                    echo "<div style='margin-top: 15px;'>";
                    echo "<button type='submit'>حفظ التعديلات</button>";
                    echo "<a href='crud.php?section=jobs' class='btn-cancel'>إلغاء والرجوع</a>";
                    echo "</div>";
                    
                    echo "</form>";
                } else {
                    echo "<p>الوظيفة غير موجودة!</p>";
                }
            }
            elseif ($section == 'jobs') {
                echo "<h2 style='color:#2980b9;'>إدارة الوظائف المتاحة</h2>";
                echo "<hr style='border:1px solid #eee; margin-bottom:20px;'>";
                
                echo "<a href='crud.php?action=add' class='btn-add'>+ إضافة وظيفة جديدة</a>";
                
                $jobs_query = mysqli_query($conn, "SELECT * FROM jobs ORDER BY job_id DESC");
                
                if (mysqli_num_rows($jobs_query) > 0) {
                    echo "<table>";
                    echo "<tr><th>رقم الوظيفة</th><th>عنوان الوظيفة</th><th>الوصف</th><th>إجراءات</th></tr>";
                    while ($row = mysqli_fetch_assoc($jobs_query)) {
                        echo "<tr>";
                        echo "<td>" . $row['job_id'] . "</td>";
                        echo "<td><strong>" . htmlspecialchars($row['title']) . "</strong></td>";
                        echo "<td>" . nl2br(htmlspecialchars($row['description'])) . "</td>";
                        
                        echo "<td>
                                <a href='crud.php?action=edit&id=" . $row['job_id'] . "' class='btn-action btn-edit'>تعديل</a> 
                                <a href='crud.php?action=delete&id=" . $row['job_id'] . "' class='btn-action btn-delete' onclick='return confirm(\"هل أنت متأكد من حذف هذه الوظيفة نهائياً؟\");'>حذف</a>
                              </td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>لا توجد وظائف مضافة حالياً.</p>";
                }
            } 
            elseif ($section == 'applications') {
                echo "<h2 style='color:#27ae60;'>مراجعة طلبات التقديم</h2>";
                echo "<hr style='border:1px solid #eee; margin-bottom:20px;'>";
                
                $sql = "SELECT applications.*, users.username, users.user_id, jobs.title, jobs.job_id as j_id 
                        FROM applications 
                        LEFT JOIN users ON applications.seeker_id = users.user_id 
                        LEFT JOIN jobs ON applications.job_id = jobs.job_id";
                        
                $app_query = mysqli_query($conn, $sql);
                
                if (!$app_query) {
                    echo "<div style='background:#f8d7da; color:#721c24; padding:15px; border-radius:5px;'><strong>خطأ برمجي في قاعدة البيانات:</strong> " . mysqli_error($conn) . "</div>";
                } elseif (mysqli_num_rows($app_query) > 0) {
                    echo "<table>";
                    echo "<tr><th>رقم الطلب</th><th>اسم المتقدم</th><th>الوظيفة المطلوبة</th><th>القرار</th><th>إجراءات</th></tr>";
                    while ($row = mysqli_fetch_assoc($app_query)) {
                        
                        $app_id = isset($row['id']) ? $row['id'] : (isset($row['application_id']) ? $row['application_id'] : '-');
                        $user_name = $row['username'] ? htmlspecialchars($row['username']) : '<span style="color:red;">مستخدم محذوف</span>';
                        $job_title = $row['title'] ? htmlspecialchars($row['title']) : '<span style="color:red;">وظيفة محذوفة</span>';
                        $status = isset($row['status']) ? $row['status'] : 'pending';
                        
                        $s_id = $row['user_id'];
                        $j_id = $row['j_id'];
                        
                        echo "<tr>";
                        echo "<td>" . $app_id . "</td>";
                        echo "<td>" . $user_name . "</td>";
                        echo "<td>" . $job_title . "</td>";
                        
                        echo "<td>";
                        if ($status == 'pending') echo "<span style='color:#f39c12; font-weight:bold;'>قيد الانتظار</span>";
                        elseif ($status == 'accepted') echo "<span style='color:#27ae60; font-weight:bold;'>تم القبول</span>";
                        elseif ($status == 'rejected') echo "<span style='color:#e74c3c; font-weight:bold;'>تم الرفض</span>";
                        else echo $status;
                        echo "</td>";
                        
                        echo "<td>";
                        if ($status == 'pending' && $s_id && $j_id) {
                            echo "<a href='crud.php?action=accept&s_id=$s_id&j_id=$j_id' class='btn-action btn-accept'>قبول</a>";
                            echo "<a href='crud.php?action=reject&s_id=$s_id&j_id=$j_id' class='btn-action btn-delete'>رفض</a>";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>لا توجد طلبات تقديم حتى الآن.</p>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
