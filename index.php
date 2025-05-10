<?php
// تأكد إن اسم الملف .php علشان الكود يشتغل
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>محل ملابس</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #232f3e;
      color: white;
      padding: 20px;
      text-align: center;
      font-size: 28px;
      font-weight: bold;
    }

    .products-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      padding: 20px;
      max-width: 1200px;
      margin: auto;
    }

    .product {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      padding: 15px;
      text-align: center;
      transition: transform 0.3s, box-shadow 0.3s, background-color 0.3s;
      cursor: pointer;
    }

    .product:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    }

    .product.selected {
      background-color: #d4edda;
      border: 1px solid #28a745;
    }

    .product img {
      width: 100%;
      height: 230px;
      object-fit: cover;
      border-radius: 8px;
      margin-top: 10px;
    }

    .form-container {
      display: none;
      background-color: #fff;
      padding: 30px;
      margin: 30px auto;
      width: 90%;
      max-width: 600px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .form-container h2 {
      text-align: center;
      color: #232f3e;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    input, button {
      padding: 12px;
      font-size: 16px;
      border-radius: 5px;
      border: 1px solid #ccc;
      width: 100%;
    }

    button {
      background-color: #ff9900;
      border: none;
      color: white;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #e68a00;
    }

    @media (max-width: 500px) {
      header {
        font-size: 20px;
        padding: 15px;
      }

      .product img {
        height: 230px;
      }

      .form-container {
        padding: 20px;
      }

      input, button {
        font-size: 14px;
        padding: 10px;
      }
    }
  </style>
</head>
<body>

<header>مرحبا بك في محل الملابس العصري</header>

<div class="products-container">
  <?php
    $conn = new mysqli("localhost", "root", "", "store");
    if ($conn->connect_error) {
      die("فشل الاتصال: " . $conn->connect_error);
    }

    $result = $conn->query("SELECT * FROM products");
    while($row = $result->fetch_assoc()) {
      $name = htmlspecialchars($row['name']);
      $desc = htmlspecialchars($row['description']);
      $img = htmlspecialchars($row['image_url']);
      echo "
        <div class='product' onclick=\"selectProduct(this, '$name')\">
          <h3>$name</h3>
          <p>$desc</p>
          <img src='$img' alt='$name'>
        </div>
      ";
    }

    $conn->close();
  ?>
</div>

<div class="form-container" id="orderForm">
  <h2>طلب المنتج</h2>
  <form action="save_order.php" method="POST">
    <input type="text" name="product_name" id="productName" readonly>
    <input type="number" name="quantity" placeholder="عدد القطع" required>
    <input type="text" name="address" placeholder="العنوان" required>
    <input type="tel" name="phone" placeholder="رقم الهاتف" required>
    <button type="submit">إرسال الطلب</button>
  </form>
</div>

<script>
  function selectProduct(element, productName) {
    document.querySelectorAll('.product').forEach(function(card) {
      card.classList.remove('selected');
    });
    element.classList.add('selected');
    document.getElementById("productName").value = productName;
    document.getElementById("orderForm").style.display = "block";
    window.scrollTo({ top: document.getElementById("orderForm").offsetTop, behavior: "smooth" });
  }
</script>

</body>
</html>