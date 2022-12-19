<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../sources/css/style1.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
<style>
body {
  font-family: Arial;

  
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #04AA6D;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}



hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}
select {
   width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 0px;
  }
}
</style>
</head>
<body>
<div class="navbar">
        <a href="index.php">
            <h2>Clothing Store</h2>
        </a>

        <a href="index.php">
            <div class="cart">
                <i class="bi bi-cart2"></i>
                <div id="cartAmount" class="cartAmount">
                    <?php
                        include '../Config/db_config.php';
                        session_start();
                    
                        $conn = OpenCon();
			    	    include "php/quantity_query.php";
			        ?>
                </div>
            </div>
        </a>
    </div>



<div class="row">
  <div class="col-75">
    <div class="container">
      <form method= "POST" action="invoice.php">
      
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="firstname" placeholder="John M. Doe">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="john@example.com">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" placeholder="New York">

           
          <div class="col-30">
            <h3>Payment</h3>
            <label for="fname">Method of paying</label>
   <select name="payment-method" class="product-id">
                  <option value="card">Card</option>
                  <option value="cash">Cash</option>
                </select>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="John More Doe">
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
            
            <div class="row">
              <div class="col-50">
                
              </div>
              <div class="col-50">
               
              </div>
            </div>
          </div>
          
        </div>
        <label>
          <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
        </label>
<?php
    $customer_id = $_SESSION["customer_id"];
    $total = $_SESSION["totalPayment"];
    $order_id = $_SESSION['orderID'];

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
<div class="col-25">
    <div class="container">
      <h4>No. of items: <?php echo $sum ?></h4>
 <?php
        $sql = "SELECT oi.quantity, p.product_name 
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
  ?>	
             <p><?php echo $quantity?>x <?php echo $name?></p>	 
  <?php
    }
  }
    ?> 
      <hr>
      <p>Total amount: ₱<?php echo $total?></p>
    </div>
  </div>
<?php
	
$firstnameErr = $emailErr = $addressErr = $cityErr = $cardnameErr = $cardnumberErr = "";
$firstname = $email = $address = $city = $cardname = $cardnumber = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["firstname"])) {
    $firstnameErr = "Name is required";
  } else {
    $firstname = test_input($_POST["firstname"]);
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
  }

  if (empty($_POST["address"])) {
    $addressErr = "";
  } else {
    $address = test_input($_POST["address"]);
  }

  if (empty($_POST["city"])) {
    $cityErr = "";
  } else {
    $city = test_input($_POST["city"]);
  }

  if (empty($_POST["cardname"])) {
    $cardnameErr = "Gender is required";
  } else {
    $cardnumber = test_input($_POST["cardnumber"]);
  }

  if (empty($_POST["cardnumber"])) {
    $cardnumberErr = "";
  } else {
    $cardnumber = test_input($_POST["cardnumber"]);
  }
}
	
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
</div>

        <input type="submit" value="Process your order" class="btn">
      </form>
	<a href ="update.php" >
	<input type="submit" value="Check your invoice" class="btn">
</a>

    </div>
  </div>
  

</body>
</html>