<?php
include '../../Config/db_config.php';
$order_item_price = $_POST["price"];
$product_id = $_POST["id"];
$conn = OpenCon();
//Put SQL code here;
session_start();
$get_order_id = "SELECT order_id FROM orders_details WHERE customer_id = " . $_SESSION["customer_id"] . " AND order_status_code = 3;";
$temp = $conn->query($get_order_id);
$order_id = $temp->fetch_assoc();
$checksum = $order_id;
$quantity = 1;
if($order_id === NULL){
	$conn->query("INSERT INTO orders_details(customer_id,date_order_placed,order_status_code) VALUES(". $_SESSION["customer_id"] . ",'" . date("Y-m-d") . "',3)");
	$temp = $conn->query($get_order_id);
	$order_id = $temp->fetch_assoc();
}
$get_product_details = "SELECT product_description FROM products WHERE product_id = " . $product_id . ";";
$other_product_details = $conn->query($get_product_details);
if(isset($_POST["subtract_from_cart"])){
	$quantity = -1;
}
$sql = "SELECT product_id FROM order_items WHERE order_id = ". $order_id["order_id"] . " AND product_id = " . $product_id . ";";
$result = $conn->query($sql);
if ($result->num_rows > 0){
	$sql = "UPDATE order_items SET quantity = (quantity + " . $quantity . ") WHERE product_id = " . $product_id . " AND order_id = " . $order_id["order_id"];
}else if($result->num_rows <= 0){
	$sql = "INSERT INTO order_items(product_id,order_id,quantity) VALUES (" . $product_id . "," . $order_id["order_id"] . ",1)";
}
$sql2 = "UPDATE orders_details SET total_amount = (total_amount + (". $order_item_price . " * " . $quantity . ")) WHERE order_id = ". $order_id["order_id"] ."";
$conn->query($sql);
$conn->query($sql2);
$sql = "DELETE FROM order_items WHERE quantity = 0";
$conn->query($sql);
echo "<script>
             window.history.go(-1);
     </script>";
?>