

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

<?php

		
		 $sql = "SELECT * FROM payment_details WHERE order_id IN (SELECT order_id from orders_details WHERE order_status_code = 4 AND customer_id = ". $_SESSION["customer_id"] . ")";		
		 
		$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {
			    while ($row = mysqli_fetch_assoc($result)) {
                    
                    $temp = $conn->query($sql);
                    $quantity = $temp->fetch_assoc();
    ?>
            <div class="item">
            <div class="details">
	    <h1><?php echo $row['order_id'] ?></h1>
            <h1><?php echo $row['payment_method_code'] ?></h1>
            <h4>Type: <?php echo $row['payment_status_code'] ?></h4>
            <h4>Size: <?php echo $row['payment_date'] ?></h4>
            
            <hr>
            <div class="price-quantity">

            
		
			</form>
            </div>
          </div>
        </div>
    <?php
      }
		$get_order_id = "SELECT order_id FROM orders_details WHERE customer_id = " . $_SESSION["customer_id"] . " AND order_status_code = 4;";
		$temp = $conn->query($get_order_id);
		$checksum = 0;
		if($temp->num_rows > 0){  
		$order_id = $temp->fetch_assoc();
		
	 	$sql = "UPDATE orders_details SET order_status_code = 1 WHERE order_id = " . $order_id["order_id"];
		if ($conn->query($sql) === TRUE) {
  		echo "";
		} else {
  		echo "" . $conn->error;
		}	

    }else{
	echo "<div class='item'>
      <div class='details'>
          <h1>Invoice</h1>
      </div>
	
  </div>";
     }

    } else {
      echo "        <div class='item'>
      <div class='details'>
          <h1>Invoice</h1>
      </div>
	
  </div>";
    }
    mysqli_close($conn);
    ?>