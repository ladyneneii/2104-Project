<?php 
  include '../Config/db_config.php';
  session_start();

  $conn = OpenCon();
  include "php/quantity_query.php";


// Customer address
//     $customer_id = $_SESSION["customer_id"];

//     $sql = "SELECT * FROM customer_details WHERE customer_id = $customer_id;"; 
//     $result = mysqli_query($conn, $sql);
//     $row = mysqli_fetch_assoc($result);

//     $username = $row['customer_username'];
//     $contact_number = $row['customer_contact_no'];
//     $address = $row['customer_complete_address'];
//     $city = $row['customer_city'];

//  Order Date and Method type
//  SELECT pd.payment_id, pd.order_id, pd.payment_method_code, pd.payment_status_code, pd.payment_date , rfp.payment_method_type 
//  FROM payment_details pd 
//  JOIN ref_payment_methods rfp ON rfp.payment_method_code = pd.payment_method_code
//  WHERE pd.order_id = order_id

// Tracking number base on order id
// SELECT sd.shipment_tracking_number 
// FROM shipment_details sd 
// JOIN payment_details pd ON pd.payment_id = sd.payment_id 
// WHERE pd.order_id = 18



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<style>
    body {
  background-color: #eee;
}

.fs-12 {
  font-size: 12px;
}

.fs-15 {
  font-size: 15px;
}

.name {
  margin-bottom: -2px;
}

.product-details {
  margin-top: 13px;
}

<?php
  // passed from Checkout.php
  $customer_id = $_SESSION['customer_id'];
  $total = $_SESSION["total"];
  $order_id = $_SESSION['order_id'];

  $sql = "SELECT cd.customer_firstname, od.date_order_placed, s.shipment_tracking_number, 
                  rf.payment_method_type, cd.customer_complete_address, cd.customer_username, 
                  cd.customer_contact_no, rs.shipment_courier_name
          FROM ref_payment_methods rf, ref_shipment_courier rs, shipment_details s
          INNER JOIN payment_details p
            ON s.payment_id = p.payment_id
          INNER JOIN orders_details od
            ON  p.order_id = od.order_id
          INNER JOIN customer_details cd
            ON od.customer_id = cd.customer_id
          WHERE p.payment_method_code = rf.payment_method_code
            AND cd.customer_id = $customer_id
            AND od.order_status_code = 4
            AND s.shipment_courier_code = rs.shipment_courier_code;";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
?>

</style>
<body>
<div class="container mt-5 mb-5">
        <div class="d-flex justify-content-center row">
            <div class="col-md-10">
                <div class="receipt bg-white p-3 rounded"><img src="../Images/logo.jpg" width="30%">
                    <h6 class="name">Hello <?php echo $row['customer_firstname']?>,</h6><span class="fs-12 text-black-50">your order has been confirmed and will be shipped in two days</span>
                    <hr>
                    <div class="d-flex flex-row justify-content-between align-items-center order-details">
                        <div><span class="d-block fs-12">Username</span><span class="font-weight-bold"><?php echo $row['customer_username']?></span></div>
                        <div><span class="d-block fs-12">Order date</span><span class="font-weight-bold"><?php echo $row['date_order_placed']?></span></div>
                        <div><span class="d-block fs-12">Payment method</span><span class="font-weight-bold"><?php echo $row['payment_method_type']?></span>
                        <!-- <img class="ml-1 mb-1" src="https://i.imgur.com/ZZr3Yqj.png" width="20"> -->
                        </div>
                        <div><span class="d-block fs-12">Shipping Address</span><span class="font-weight-bold text-success"><?php echo $row['customer_complete_address']?></span></div>
                    </div>
                    &nbsp;
                    <div class="d-flex flex-row justify-content-between align-items-center order-details">
                        <div><span class="d-block fs-12">Courier Name</span><span class="font-weight-bold"><?php echo $row['shipment_courier_name']?></span></div>
                        <div><span class="d-block fs-12">Courier Contact No</span><span class="font-weight-bold"><?php echo $row['customer_contact_no']?></span></div>
                        <div><span class="d-block fs-12">Tracking Number</span><span class="font-weight-bold"><?php echo $row['shipment_tracking_number']?></span>
                        <!-- <img class="ml-1 mb-1" src="https://i.imgur.com/ZZr3Yqj.png" width="20"> -->
                        </div>
                    </div>

                    <?php
                      $sql = "SELECT * 
                              FROM products p, ref_product_type rp, order_items oi, orders_details od
                              WHERE p.product_type_code = rp.product_type_code 
                                AND p.product_id = oi.product_id 
                                AND oi.order_id = od.order_id 
                                AND od.order_status_code = 4
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
                                        WHERE order_status_code = 4
                                          AND customer_id = $customer_id
                                      )";
                              $result = mysqli_query($conn, $sql); 
                              $row = mysqli_fetch_assoc($result); 
                              $sum = $row['value_sum'];	

                        $sql = "SELECT oi.quantity, p.product_name, p.product_price, rp.product_type_description
                                FROM ref_product_type rp, order_items oi 
                                INNER JOIN products p 
                                  ON oi.product_id = p.product_id 
                                WHERE oi.order_id = (
                                  SELECT order_id 
                                  FROM orders_details 
                                  WHERE customer_id = $customer_id 
                                    AND order_status_code = 4
                                    AND rp.product_type_code = p.product_type_code
                                );";
                        $result = mysqli_query($conn, $sql);
                          if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                              $name = $row['product_name'];
                              $quantity = $row['quantity'];
                              $product_price = $row['product_price'];
                              $product_type_description = $row['product_type_description'];
                      ?>	

                    <!-- Display Items -->
                    <div class="d-flex justify-content-between align-items-center product-details">
                        <div class="d-flex flex-row product-name-image">
                            <!-- <img class="rounded" src="https://i.imgur.com/GsFeDLn.jpg" width="80"> -->
                            <div class="d-flex flex-column justify-content-between ml-2">
                                <div><span class="d-block font-weight-bold p-name"><?php echo $name?></span></div>
                                <span class="fs-12"><?php echo $product_type_description?></span>
                                <span class="fs-12">Qty: <?php echo $quantity?>pcs</span>
                            </div>
                        </div>
                        <div class="product-price">
                            <h5>₱<?php echo $product_price*$quantity?></h5>
                        </div>
                    </div>

                    <?php }
                     }
                    }
                     }
                          // set order_status_code to be completed
                          $sql = "UPDATE orders_details SET order_status_code = 1 WHERE $order_id;";
                          $conn->query($sql);
                     ?>
                    <div class="mt-5 amount row">
                        <!-- <div class="d-flex justify-content-center col-md-6">
                            <img src="https://i.imgur.com/AXdWCWr.gif" width="250" height="100">
                        </div> -->
                        <div class="col-md-6">
                            <div class="billing">
                                <!-- <div class="d-flex justify-content-between"><span>Subtotal</span><span class="font-weight-bold">$120</span></div>
                                <div class="d-flex justify-content-between mt-2"><span>Shipping fee</span><span class="font-weight-bold">$15</span></div> -->
                                <!-- <div class="d-flex justify-content-between mt-2"><span>Tax</span><span class="font-weight-bold">$5</span></div>
                                <div class="d-flex justify-content-between mt-2"><span class="text-success">Discount</span><span class="font-weight-bold text-success">$25</span></div> -->
                                <hr>
                                <div class="d-flex justify-content-between mt-1"><span class="font-weight-bold">Total</span><span class="font-weight-bold text-success">₱<?php echo $total ?></span></div>
                            </div>
                        </div>
                    </div>
                    <!-- <span class="d-block">Expected delivery date</span><span class="font-weight-bold text-success">12 March 2020</span><span class="d-block mt-3 text-black-50 fs-15">We will be sending a shipping confirmation email when the item is shipped!</span> -->
                    <hr>
                    <div class="d-flex justify-content-between align-items-center footer">
                        <div class="thanks"><span class="d-block font-weight-bold">Thanks for shopping!</span>
                        <!-- <span>Group 1</span></div> -->
                        <!-- <div class="d-flex flex-column justify-content-end align-items-end"><span class="d-block font-weight-bold">Need Help?</span><span>Call - 974493933</span></div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>