<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clothing_store";

// الاتصال بقاعدة البيانات
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// استقبال البيانات من النموذج
$product_name = $_POST['product_name'];
$quantity = $_POST['quantity'];
$address = $_POST['address'];
$phone = $_POST['phone'];

// إدخال البيانات لقاعدة البيانات
$sql = "INSERT INTO orders (product_name, quantity, address, phone) 
        VALUES ('$product_name', '$quantity', '$address', '$phone')";

if ($conn->query($sql) === TRUE) {
    echo "تم إرسال الطلب بنجاح!";
} else {
    echo "خطأ: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>