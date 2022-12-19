<?php 

include '../Config/db_config.php';
session_start();


if (!isset($_SESSION['admin_name'])) {
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
    <a href="index.html">
      <h2>Clothing Store</h2>
    </a>
    <span><h2><?php echo $_SESSION['admin_name']?></h2></span>
    <a href="../logout.php">
    <div class="cart">
    <i class="bi bi-box-arrow-right"></i>
    </div>
    </a>

    <!-- <a href="">
      <div class="cart">
        <i class="bi bi-cart2"></i>
        <div id="cartAmount" class="cartAmount">0</div>
      </div>
    </a> -->

  </div>

  <div class="shop" id="shop">


  </div>

</body>
<!-- <script src="src/Data.js"></script>
<script src="src/main.js"></script> -->

</html>