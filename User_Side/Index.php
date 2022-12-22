<?php

include '../Config/db_config.php';
session_start();

$conn = OpenCon();

		if (!isset($_SESSION['customer_name'])) {
			header('location:../login.php');
		}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clothing Store</title>
  <link rel="stylesheet" href="../sources/css/style1.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>

<body>
  <div class="navbar">
  <img src="../Images/logo.jpg" width="13%">
    <div style="display: flex; flex-direction: row; flex-wrap: nowrap;gap: 25px; justify-content: space-around; align-content: space-between;">
      <h1>Welcome, <?php echo $_SESSION['customer_name'] ?>!</h1>
      <a href="cart.php">
        <div class="cart">
          <i class="bi bi-cart2"></i>
          <div id="cartAmount" class="cartAmount">
			<?php
				include "php/quantity_query.php";
			?>
		  </div>
        </div>
      </a>

      <a href="../logout.php">
        <div class="cart">
          <i class="bi bi-box-arrow-right"></i>
        </div>
      </a>
    </div>

  </div>

  <div class="shop" id="shop">


    <?php

		$sql = "SELECT * FROM products p, ref_product_type rp 
			WHERE p.product_type_code = rp.product_type_code
			ORDER BY p.product_id;";

    $temp = $conn->query($sql);
    $check = $temp->fetch_assoc();

		$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {
			  while ($row = mysqli_fetch_assoc($result)) {
          if ($check["product_quantity"] > 0){
    ?>
            <div class="item">
              <div class="details">
                <h1><?php echo $row['product_name'] ?></h1>
                <h4>Type: <?php echo $row['product_type_description'] ?></h4>
                <h4>Size: <?php echo $row['product_size'] ?></h4>
                <h4>Quantity left: <?php echo $row['product_quantity'] ?></h4>
                <p><?php echo $row['product_description'] ?></p>
                <hr>
                <div class="price-quantity">

                <h2> ₱ <?php echo $row['product_price'] ?></h2>
          <form action="php/update.php" method="post">
            <input type="submit" style="width: 110px; font-weight: bold; font-size: 15px; background: #208b20;" class="btn btn-success" name="add_to_cart" value="Add">
            <input type="hidden" name="id" value="<?php echo $row['product_id']; ?>">
            <input type="hidden" name="price" value="<?php echo $row['product_price']; ?>">
          </form>
                </div>
              </div>
            </div>
    <?php
            }
            $check = $temp->fetch_assoc();
        }
    } else {
      echo "0 Products";
    }
    mysqli_close($conn);
    ?>
  </div>

</body>
<!-- <script src="src/Data.js"></script>
<script src="src/main.js"></script> -->

</html>