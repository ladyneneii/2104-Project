<?php
$sql = "SELECT SUM(quantity) AS total FROM order_items WHERE order_id = (SELECT order_id FROM orders_details WHERE customer_id = " . $_SESSION["customer_id"] . " AND order_status_code = 3);";
$result = $conn->query($sql);
$temp = $result->fetch_assoc();
if ($temp["total"] === NULL){
	echo 0;
}else{
   echo $temp['total'];
}
?>