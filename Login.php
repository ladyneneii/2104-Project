<?php

include 'Config/db_config.php';
session_start();

$conn = OpenCon();

$user_typ = "SELECT * FROM `ref_user_category`";
$all_user = mysqli_query($conn, $user_typ);

if (isset($_POST['submit'])) {

  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $pass = md5($_POST['password']);

  $select = " SELECT * FROM `customer_details` WHERE `customer_username` = '$username' 
                && `customer_password` = '$pass'";
  $result = mysqli_query($conn, $select);

  $select1 = " SELECT * FROM `admin_details` WHERE `admin_username` = '$username' 
    && `admin_password` = '$pass'";
  $result1 = mysqli_query($conn, $select1);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    if ($row['user_category_id'] == '1') {
      $_SESSION['customer_name'] = $row['customer_firstname'];
      $_SESSION['customer_id'] = $row['customer_id'];
      header('location:user_side/index.php');
    }
  }

  if (mysqli_num_rows($result1) > 0) {
    $row1 = mysqli_fetch_array($result1);
    if ($row1['user_category_id'] == '2') {
      $_SESSION['admin_name'] = $row1['admin_username'];
      $_SESSION['admin_id'] = $row['admin_id'];
      header('location:admin_side/dashboard.php');
    }
  } else {
    $error[] = 'incorrect username or password';
  }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="sources/css/style1.css">
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"> -->
  <!-- JavaScript Bundle with Popper -->

</head>

<body>
  <div class="navbar">
    <a href="">
      <h2><center>Clothing Store</center></h2>
    </a>


  </div>

  <div class="wrapper">
    <div class="container">
      <form action="" method="POST" autocomplete="off">

        <?php
        if (isset($error)) {
          foreach ($error as $error) {
            echo '<span class="error-msg">' . $error . '</span> <br>';
          };
        };
        ?>

        <div class="title">Login</div>

        <div class="input-form">

          <div class="section-2">
            <div class="items">
              <label for="username" class="label">Username</label>
              <input type="text" name="username" class="input" placeholder="ex. xxxx" required>
            </div>
          </div>

          <div class="section-2">
            <div class="items">
              <label for="password" class="label">Password</label>
              <input type="passwords" name="password" class="input" placeholder="ex. xxxx" required>
            </div>
          </div>


          <button type="submit" name="submit" class="submit_btn">Login now</button>

          <!-- <button type="button" style="text-align: center;text-align: center; width: 100%;background-color: #fff;border: none;padding: 10px;
          font-size: 14px;" onclick="location.href='cart.html'">Return to cart</button> -->
          <br>
          <br>
          <p><b>
              <center>don't have an account?</center>
            </b>
          <div class="rebtn" onclick="location.href='register.php'">Signup</div>
          </p>
        </div>
      </form>
    </div>
  </div>
</body>

</html>