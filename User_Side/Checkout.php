<?php 
  include '../Config/db_config.php';
  session_start();

  $conn = OpenCon();
  include "php/quantity_query.php";
?>
  <!DOCTYPE html>
  <html lang="en">
    
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="../Sources/CSS/test.css">
      <title>
        Checkout Page
      </title>

      <style>
        body{

        background-color: #eee;
        }

        .container{

        height: 100vh;

        }

        .card{
        border:none;
        }

        .form-control {
        border-bottom: 2px solid #eee !important;
        border: none;
        font-weight: 600
        }

        .form-control:focus {
        color: #495057;
        background-color: #fff;
        border-color: #8bbafe;
        outline: 0;
        box-shadow: none;
        border-radius: 0px;
        border-bottom: 2px solid blue !important;
        }



        .inputbox {
        position: relative;
        margin-bottom: 20px;
        width: 100%
        }

        .inputbox span {
        position: absolute;
        top: 7px;
        left: 11px;
        transition: 0.5s
        }

        .inputbox i {
        position: absolute;
        top: 13px;
        right: 8px;
        transition: 0.5s;
        color: #3F51B5
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0
        }

        .inputbox input:focus~span {
        transform: translateX(-0px) translateY(-15px);
        font-size: 12px
        }

        .inputbox input:valid~span {
        transform: translateX(-0px) translateY(-15px);
        font-size: 12px
        }

        .card-blue{

        background-color: #492bc4;
        }

        .hightlight{

        background-color: #5737d9;
        padding: 10px;
        border-radius: 10px;
        margin-top: 15px;
        font-size: 14px;
        }

        .yellow{

        color: #fdcc49; 
        }

        .decoration{

        text-decoration: none;
        font-size: 14px;
        }

        .btn-success {
        color: #fff;
        background-color: #492bc4;
        border-color:#492bc4;
        }

        .btn-success:hover {
        color: #fff;
        background-color:#492bc4;
        border-color: #492bc4;
        }


        .decoration:hover{

        text-decoration: none;
        color: #fdcc49; 
        }
      </style>
    </head>
    
    <body>
    <form method= "POST" action="invoice.php">
      <div class="container mt-5 px-5">
        <div class="mb-4">
          <img src="../Images/logo.jpg" width="20%">
          <span style="font-size: 40px;
          font-weight: bold;">
            Confirm your Order
          </span>
          &nbsp;
          <h2>
          </h2>
        </div>
        <div class="row">
          <div class="col-md-8">
            <div class="card p-3">
              <h6 class="text-uppercase" style=" background: black; color: white; text-align: center; font-family: -apple-system,BlinkMacSystemFont,"
              Segoe UI ",Roboto,"Helvetica Neue ",Arial,"Noto Sans ",sans-serif,"Apple
              Color Emoji ","Segoe UI Emoji ","Segoe UI Symbol ","Noto Color Emoji "">
                Payment details
              </h6>
              <div class="row mt-3">
                <div class="col-md-6">
                  <div class="mt-1 mr-2">
                    <div class="custom-control custom-radio">
                      <input id="credit" name="payment-method" type="radio" class="custom-control-input"
                      checked required>
                      <label class="custom-control-label" for="credit">
                        Cash
                      </label>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mt-1 mr-2">
                    <div class="custom-control custom-radio">
                      <input id="debit" name="payment-method" type="radio" class="custom-control-input"
                      required>
                      <label class="custom-control-label" for="debit">
                        Credit
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <div class="row mt-3">
              <div class="col-md-6">
              <div class="inputbox mt-1 mr-2">
              <div class="form-group">
              <label for="exampleInputEmail1">
              Name on Card
              </label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
              placeholder="pre defined ni siya sa username">
              </div>
              </div>
              </div>
              <div class="col-md-6">
              <div class="inputbox mt-1 mr-2">
              <div class="form-group">
              <label for="exampleInputEmail1">
              Card Number
              </label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
              placeholder="same here">
              </div>
              </div>
              </div>
              </div>
              <div class="row mt-2">
              <div class="col-md-6">
              <div class="inputbox mt-3 mr-2">
              <div class="form-group">
              <label for="exampleInputEmail1">
              Expiry Date
              </label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
              placeholder="same here">
              </div>
              </div>
              </div>
              <div class="col-md-6">
              <div class="inputbox mt-3 mr-2">
              <div class="form-group">
              <label for="exampleInputEmail1">
              CVV
              </label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
              placeholder="same here">
              </div>
              </div>
              </div>
              </div> -->
              <!-- Billing -->
              <?php
                $customer_id = $_SESSION["customer_id"];
                // passing to Invoice_display.php
                $_SESSION['customer_id'] = $customer_id;

                $sql = "SELECT * FROM customer_details WHERE customer_id = $customer_id;"; 
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);

                $username = $row['customer_username'];
                $contact_number = $row['customer_contact_no'];
                $address = $row['customer_complete_address'];
                $city = $row['customer_city'];
              ?>
              <div class="mt-4 mb-4">
                <h6 class="text-uppercase" style=" background: black; color: white; text-align: center; font-family: -apple-system,BlinkMacSystemFont,"
                Segoe UI ",Roboto,"Helvetica Neue ",Arial,"Noto Sans ",sans-serif,"Apple
                Color Emoji ","Segoe UI Emoji ","Segoe UI Symbol ","Noto Color Emoji "">
                  Billing Address
                </h6>
                <div class="row mt-3">
                  <div class="col-md-6">
                    <div class="inputbox mt-1 mr-2">
                      <div class="form-group">
                        <label for="exampleInputEmail1">
                          Username
                        </label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Enter your email" value="<?php echo $username ?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="inputbox mt-1 mr-2">
                      <div class="form-group">
                        <label for="exampleInputEmail1">
                          Contact Number
                        </label>
                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Enter your contact number" value="<?php echo $contact_number ?>" required>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-6">
                    <div class="inputbox mt-3 mr-2">
                      <div class="form-group">
                        <label for="exampleInputEmail1">
                          Complete Address
                        </label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Enter your address" value="<?php echo $address ?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="inputbox mt-3 mr-2">
                      <div class="form-group">
                        <label for="exampleInputEmail1">
                          City
                        </label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Enter your city" value="<?php echo $city ?>" required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Shipment Courier -->
              <div class="mt-4 mb-4">
                <h6 class="text-uppercase" style=" background: black; color: white; text-align: center; font-family: -apple-system,BlinkMacSystemFont,"
                Segoe UI ",Roboto,"Helvetica Neue ",Arial,"Noto Sans ",sans-serif,"Apple
                Color Emoji ","Segoe UI Emoji ","Segoe UI Symbol ","Noto Color Emoji "">
                  Shipment Courier
                </h6>
                <div class="row mt-3">
                  <div class="mt-1 mb-2">
                    <?php $sql1="SELECT * FROM `ref_shipment_courier`;" ;
                     $getcourier = mysqli_query($conn,$sql1);
                    ?>
                      <select class="form-select" aria-label="Default select example" name="shipment_courier_code">
                        <option selected value="">
                          Select Courier
                        </option>
                        <?php while($cc = mysqli_fetch_assoc($getcourier)):?>
                          <option value="<?php echo $cc['shipment_courier_code']; ?>">
                            <?php echo $cc[ 'shipment_courier_code']; ?>
                              <?php echo $cc[ 'shipment_courier_name']; ?>
                          </option>
                          }?>
                          <?php endwhile; // While loop must be terminated ?>
                      </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="mt-1 mb-2 d-flex justify-content-center">
              <a class="btn btn-danger px-3" href="javascript:history.go(-1)">
                Back to Cart
              </a>
              &NonBreakingSpace;
              <input type="submit" value="Complete Purchase" class="btn btn-success px-3">
              &NonBreakingSpace;
              <a href="Invoice_display.php" class="btn btn-info" role="button">Check Invoice</a>
            </div>
          </div>
          <!-- Cart Section -->
          <?php
            $total = $_SESSION["totalPayment"];
            $order_id = $_SESSION['orderID'];

            // passing to Invoice_display.php
            $_SESSION['total'] = $total;
            $_SESSION['order_id'] = $order_id;

            $result = mysqli_query($conn, $sql);

            $sql = "SELECT * 
                    FROM products p, ref_product_type rp, order_items oi, orders_details od
                    WHERE p.product_type_code = rp.product_type_code 
                      AND p.product_id = oi.product_id 
                      AND oi.order_id = od.order_id 
                      AND od.order_status_code = 3
                    ORDER BY p.product_id;";

            $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    $name = $row['product_name'];
                    $quantity = $row['quantity'];
                    $sql = "SELECT SUM(quantity) AS value_sum 
                            FROM order_items 
                            WHERE order_id = (
                              SELECT order_id 
                              FROM orders_details 
                              WHERE order_status_code = 3 
                                AND customer_id = $customer_id
                            )";
                    $result = mysqli_query($conn, $sql); 
                    $row = mysqli_fetch_assoc($result); 
                    $sum = $row['value_sum'];	
            ?>
          <div class="col-md-4">
            <div class="card card-blue p-3 text-white mb-3">
              <span>
                You have to pay
              </span>
              <div class="d-flex flex-row align-items-end mb-3">
                <h1 class="mb-0 yellow">
                  ₱<?php echo $total ?>
                </h1>
              </div>
              <span>
                No. of Items:
                <b style="color: yellow; font-size:20px;">
                  <?php echo $sum ?> pcs.
                </b>
              </span>
              <!-- <span>Enjoy all the features and perk after you complete the payment</span>
              <a href="#" class="yellow decoration">Know all the features</a> -->
              <ul class="list-group mb-3">
              <?php
                $sql = "SELECT oi.quantity, p.product_name, p.product_price
                        FROM order_items oi 
                        INNER JOIN products p 
                          ON oi.product_id = p.product_id 
                        WHERE oi.order_id = (
                          SELECT order_id 
                          FROM orders_details 
                          WHERE customer_id = $customer_id 
                            AND order_status_code = 3
                        );";
                $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      $name = $row['product_name'];
                      $quantity = $row['quantity'];
                      $product_price = $row['product_price'];
              ?>	
                      <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                          <!-- <h6 class="my-0">Product name</h6> -->
                          <small class="text-muted">
                            <?php echo $quantity?>x <?php echo $name?>
                          </small>
                        </div>
                        <span class="text-muted">
                          ₱<?php echo $product_price*$quantity?>
                        </span>
                      </li>
              <?php
                    }
                  }
              ?> 
              </ul>
              <?php

      }
	
    } else {
      echo "        <div class='item'>
      <div class='details'>
          <h1>0 Products</h1>
      </div>
	
  </div>";
    }
    mysqli_close($conn);
    ?>
              <!-- <div class="hightlight">
              <span>
              </span>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </form>
    </body>
  
  </html>