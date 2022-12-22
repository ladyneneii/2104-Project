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
        <a href="index.php">
        <img src="../Images/logo.jpg" width="13%">
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
    <div id="label" class="text-center">
    <?php
        $customer_id = $_SESSION['customer_id'];
        $total = 0;
 		$sql = "SELECT oi.product_id, oi.order_id, SUM(oi.quantity), (SUM(oi.quantity) * p.product_price) AS ProductPayment
                FROM order_items oi, orders_details od, products p
                WHERE oi.order_id = od.order_id 
                    AND oi.product_id = p.product_id
                    AND oi.order_id = (
                        SELECT order_id
                        FROM orders_details
                        WHERE order_status_code = 3
                            AND customer_id = $customer_id
                    )
                GROUP BY oi.product_id;";
		$result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $total += $row['ProductPayment'];
                $order_id = $row['order_id'];
    ?>

    <?php
            } 
            $_SESSION['totalPayment'] = $total;
            $_SESSION['orderID'] = $order_id;
    ?>
            <h2>Total Bill : ₱<?php echo $total?></h2>
    <?php
    } else {
        echo "<h2>Total Bill : ₱0	</h2>";
    }
    ?>
	
    <a href="Checkout.php">
    <button type="submit" name="submit" onClick="Checkout.php" class="checkout">Checkout</button>
    </a>

    </div>
    <?php
		$sql = "SELECT * FROM products p, ref_product_type rp, order_items oi, orders_details od
			WHERE p.product_type_code = rp.product_type_code 
                AND p.product_id = oi.product_id 
                AND oi.order_id = od.order_id 
                AND od.order_status_code = 3
                AND oi.order_id IN (
                    SELECT order_id
                    FROM orders_details
                    WHERE customer_id = $customer_id
                )
			ORDER BY p.product_name;";

		$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {
			    while ($row = mysqli_fetch_assoc($result)) {
                    $sql = "SELECT quantity 
                            FROM order_items 
                            WHERE order_id = (
                                SELECT order_id 
                                FROM orders_details 
                                WHERE order_status_code = 3 
                                    AND customer_id = $customer_id
                            ) 
                            AND product_id = ". $row["product_id"];
                    $temp = $conn->query($sql);
                    $quantity = $temp->fetch_assoc();
    ?>
                    <div class="shopping-cart" id="shopping-cart">
                    <br>
                    <div class="cart-item">
                    <div class="details">
                        <h1><?php echo $row['product_name'] ?></h1>
                        <h4>Type: <?php echo $row['product_type_description'] ?></h4>
                        <h4>Size: <?php echo $row['product_size'] ?></h4>
                        <p><?php echo $row['product_description'] ?></p>
                        <hr>
                        <div class="price-quantity">
                            <h2> ₱ <?php echo ($row['product_price'] * $quantity["quantity"])?></h2>
                            <form action="php/update.php" method="post">
                                <div class="buttons">
                                    <button type="submit" name="subtract_from_cart" value="-" class="bi bi-dash-lg"></button>
                                    <div class="quantity">
                                        <h3><?php echo ($quantity["quantity"])?></h3>
                                    </div>
                                    <button type="submit" name="add_to_cart" value="+" class="bi bi-plus-lg"></button>
                                </div>
                                <input type="hidden" name="id" value="<?php echo $row['product_id']; ?>">
                                <input type="hidden" name="price" value="<?php echo $row['product_price']; ?>">
                            </form>
                        </div>
                    </div>
                    </div>
                    </div>
    <?php
                }
            } else {
                echo "        
                <h1><center>Cart is Empty</center></h1>
                ";
            }
                mysqli_close($conn);
    ?>
    <div id="label" class="text-center"></div>
</body>

</html>