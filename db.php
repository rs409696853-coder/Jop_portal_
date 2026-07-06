<?php
$conn = mysqli_connect('localhost', 'root', '', 'sondos');

if (!$conn) {
    die("خطأ في الاتصال بقاعدة البيانات: " . mysqli_connect_error());
}
?>