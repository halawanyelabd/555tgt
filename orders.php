<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clothing_store";

// الاتصال بقاعدة البيانات
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

// جلب البيانات من جدول الطلبات
$sql = "SELECT * FROM orders ORDER BY order_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>عرض الطلبات</title>
    <style>
        table { width: 80%; margin: auto; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #eee; }
        h2 { text-align: center; }
    </style>
</head>
<body>

<h2>قائمة الطلبات</h2>

<table>
    <tr>
    
        <th>اسم المنتج</th>
        <th>الكمية</th>
        <th>العنوان</th>
        <th>رقم الهاتف</th>
        <th>تاريخ الطلب</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    
                    <td>{$row['product_name']}</td>
                    <td>{$row['quantity']}</td>
                    <td>{$row['address']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['order_date']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>لا توجد طلبات حالياً</td></tr>";
    }
    $conn->close();
    ?>

</table>

</body>
</html>