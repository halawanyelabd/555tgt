<?php
$conn = new mysqli("localhost", "اسم_المستخدم", "كلمة_السر", "store");
if ($conn->connect_error) {
  die("فشل الاتصال: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM products");

echo '<div class="product-grid">';
while($row = $result->fetch_assoc()) {
  echo '
    <div class="product-card" onclick="selectProduct(this, \''.htmlspecialchars($row['name']).'\')">
      <img src="'.htmlspecialchars($row['image_url']).'" alt="'.htmlspecialchars($row['name']).'">
      <h3>'.htmlspecialchars($row['name']).'</h3>
      <p>'.htmlspecialchars($row['description']).'</p>
    </div>
  ';
}
echo '</div>';

$conn->close();
?>