<?php
session_start();
require_once 'db.php';
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>الوظائف المتاحة</title>
    <style>
        body { font-family: Tahoma, sans-serif; background-color: #f4f6f9; margin: 0; padding: 0; }
        .header { background: #2c3e50; color: white; padding: 15px 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .nav { display: flex; justify-content: space-between; align-items: center; max-width: 1100px; margin: auto; }
        .nav h2 { margin: 0; color: #3498db; }
        .nav a { color: white; text-decoration: none; padding: 8px 15px; border-radius: 4px; font-weight: bold; transition: 0.3s; }
        .nav a.logout { background-color: #e74c3c; }
        .nav a.login { background-color: #3498db; }
        .container { max-width: 1100px; margin: 40px auto; padding: 0 20px; display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 25px; }
        .job-card { background: white; border-radius: 8px; padding: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); transition: transform 0.3s; border-top: 4px solid #3498db; display: flex; flex-direction: column; }
        .job-card:hover { transform: translateY(-5px); }
        .job-img { width: 100%; height: 160px; object-fit: cover; border-radius: 5px; margin-bottom: 15px; }
        .job-title { color: #2c3e50; font-size: 20px; margin-bottom: 10px; font-weight: bold; }
        .job-desc { color: #7f8c8d; font-size: 14px; line-height: 1.6; margin-bottom: 20px; flex-grow: 1; }
        .btn-apply { display: block; text-align: center; background: #27ae60; color: white; padding: 12px; text-decoration: none; border-radius: 4px; font-weight: bold; }
        .btn-apply:hover { background: #219150; }
    </style>
</head>
<body>

    <div class="header">
        <div class="nav">
            <h2>💼 بوابة التوظيف</h2>
            <div>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <span style="margin-left: 15px;">مرحباً بك، <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></span>
                    <a href="logout.php" class="logout">تسجيل الخروج</a>
                <?php else: ?>
                    <a href="login.php" class="login">تسجيل الدخول</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="container">
        <?php
        $query = mysqli_query($conn, "SELECT * FROM jobs ORDER BY job_id DESC");
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                if (strpos($row['title'], 'برمجيات') !== false) {
                    $image_url = "https://images.unsplash.com/photo-1542831371-29b0f74f9713?q=80&w=600&auto=format&fit=crop";
                } elseif (strpos($row['title'], 'منسق') !== false) {
                    $image_url = "https://images.unsplash.com/photo-1543269664-56d93c1b41a6?q=80&w=600&auto=format&fit=crop";
                } elseif (strpos($row['title'], 'عمليات') !== false) {
                    $image_url = "https://images.unsplash.com/photo-1581092160607-ee22621dd758?q=80&w=600&auto=format&fit=crop";
                } else {
                    $image_url = "https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=600&auto=format&fit=crop";
                }

                echo "<div class='job-card'>";
                echo "<img src='" . $image_url . "' class='job-img'>";
                echo "<div class='job-title'>" . htmlspecialchars($row['title']) . "</div>";
                echo "<div class='job-desc'>" . nl2br(htmlspecialchars($row['description'])) . "</div>";
                echo "<a href='apply_action.php?job_id=" . $row['job_id'] . "' class='btn-apply'>التقديم الآن 🚀</a>";
                echo "</div>";
            }
        } else {
            echo "<p style='text-align:center; width:100%;'>لا توجد وظائف متاحة حالياً.</p>";
        }
        ?>
    </div>

</body>
</html>