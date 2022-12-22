<?php
session_start();
include "../Config/db_config.php";

$conn = OpenCon();

if(empty($_POST['shipment_courier_code']))
{
    echo "Please choose a courier.";
}
else
{ 
    $method = $_POST["payment-method"];
    $get_order_id = "SELECT order_id FROM orders_details WHERE customer_id = " . $_SESSION["customer_id"] . " AND order_status_code = 3;";
    $temp = $conn->query($get_order_id);
    $checksum = 0;
    if($temp->num_rows > 0){  
    $order_id = $temp->fetch_assoc();
    $sql = "SELECT quantity, product_id FROM order_items WHERE order_id = " . $order_id["order_id"];
    $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
            $sql2 = "SELECT product_quantity FROM products WHERE product_id = " . $row["product_id"];
            $result = $conn->query($sql2);
            $row2 = $result->fetch_assoc();
            if($row["quantity"] > $row2["product_quantity"]){
                echo "<script>alert('Order of Product " . $row["product_id"] . " has exceeded total quantity. (Current Stock: " . $row2["product_quantity"] . "). Please order equal or less to this.')</script><br>";
                $checksum = 1;
            }
        }
    }else{
        echo "You do not have any Orders!";
    }



    if($temp->num_rows > 0 && $checksum == 0){
        if($method === "cash"){
            $temp2 = 1;
        }else{
            $temp2 = 2;
        }
        $sql = "SELECT order_status_code FROM orders_details WHERE order_id = ". $order_id["order_id"];
        $temp = $conn->query($sql);
        $result = $temp->fetch_assoc();
        if($result["order_status_code"] == 3){
            print_r("passed");
            $temp = $conn->query($get_order_id);
            $sql = "INSERT INTO payment_details(order_id,payment_method_code,payment_status_code,payment_date) VALUES (" . $order_id["order_id"] . "," . $temp2 . ",1," . date('Y') .")";
            $conn->query($sql);
            $sql = "UPDATE orders_details SET order_status_code = 4 WHERE order_id = " . $order_id["order_id"];
            $conn->query($sql);
            if($temp->num_rows > 0){  
                print_r("passed");
                $order_id = $temp->fetch_assoc();
                $sql = "SELECT quantity, product_id FROM order_items WHERE order_id = " . $order_id["order_id"];
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()){
                    print_r("passed");
                    $sql = "UPDATE products SET product_quantity = (product_quantity - " . $row["quantity"] . ") WHERE product_id = " . $row["product_id"];
                    $conn->query($sql);
                    $sql = "SELECT product_quantity FROM products WHERE product_id = ". $row["product_id"];
                    $test = $conn->query($sql);
                    if($test->fetch_assoc()["product_quantity"] == 0){
                        $sql = "UPDATE products SET product_stocks = 'Out of Stock' WHERE product_id = " . $row["product_id"];
                            $conn->query($sql);
                    }
                }
                $order_id = $order_id["order_id"];

                $sql = "SELECT payment_id FROM payment_details WHERE order_id = $order_id;";
                $temp = $conn->query($sql);
                $result = $temp->fetch_assoc();

                $payment_id = $result["payment_id"];
                $shipment_courier_code = $_POST["shipment_courier_code"];
                $shipment_tracking_number = rand(10000,99999);
                
                $sql = "INSERT INTO shipment_details (payment_id, shipment_courier_code, shipment_tracking_number, delivery_status_code) VALUES ($payment_id, $shipment_courier_code, $shipment_tracking_number, 2);";
                $conn->query($sql);

                $sql = "INSERT INTO invoice_details (payment_id) VALUES ($payment_id);";
                $conn->query($sql);
            }
        }else{
            echo "<script>alert('Order already processed.')</script>";
        }
    }
    echo "<script>
                window.history.go(-1);
        </script>";
}
    ?>
