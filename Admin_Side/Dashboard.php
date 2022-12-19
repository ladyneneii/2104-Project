<?php

include '../Config/db_config.php';
session_start();

$conn = OpenCon();


//Fetching top 5 ordered products

// $topproducts_query = "SELECT `order_product_id`,`order_product` AS Products , SUM(`order_qty`) AS TotalSales FROM `orders_tbl` GROUP BY `order_product_id` ORDER BY SUM(`order_qty`) DESC LIMIT 5";
// $topproducts_query = "SELECT p.product_id, p.product_name AS Products, SUM(oi.quantity) AS TotalSales FROM orders_details od, order_items oi, products p WHERE od.order_id = oi.order_id AND oi.product_id = p.product_id ORDER BY oi.product_id ASC LIMIT 5";
// $topproducts_query = "SELECT p.product_id, p.product_name AS Products, SUM(od.total_amount) AS TotalSales FROM orders_details od, order_items oi, products p GROUP BY oi.product_id ORDER BY (oi.quantity) DESC LIMIT 5";
// $topproducts_result = mysqli_query($conn,$topproducts_query);

// $Products = array();
// $TotalSales = array();
// foreach ($topproducts_result as $row) {
//     $Products[] = $row['Products'];
//     $TotalSales[] = $row['TotalSales'];
// }

// SELECT p.product_id, p.product_name AS Products, SUM(od.total_amount) AS TotalSales FROM orders_details od, order_items oi, products p WHERE od.order_id = oi.order_id AND oi.product_id = p.product_id GROUP BY oi.product_id ORDER BY (od.total_amount) DESC LIMIT 5

// //Fetching top 5 ordered products percentage

// $productsstock_query ="SELECT order_product AS ProductName,ROUND(SUM(order_qty) * 100 / (SELECT SUM(order_qty) FROM orders_tbl)) AS OrderPercentage FROM orders_tbl GROUP BY order_product ORDER BY SUM(`order_qty`) DESC LIMIT 5;";
// $ProductName = array();
// $ProductOrderPercentage=array();

// $productsstock_result = mysqli_query($con,$productsstock_query);
// foreach($productsstock_result as $row){
//     $ProductName[] =$row['ProductName'];
//     $ProductOrderPercentage[] =$row['OrderPercentage'];
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="../sources/css/fontawesome.min.css">
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="../sources/css/bootstrap_admin.min.css">
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="../sources/css/style_ad1.css">
    <!--
	Product Admin CSS Template
	https://templatemo.com/tm-524-product-admin
	-->
</head>

<body id="reportsPage">
    <div class="" id="home">
        <nav class="navbar navbar-expand-xl">
            <div class="container h-100">
                <a class="navbar-brand" href="dashboard.php">
                    <h1 class="tm-site-title mb-0">Admin Dashboard</h1>
                </a>
                <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars tm-nav-icon"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto h-100">
                        <li class="nav-item">
                            <a class="nav-link active" href="dashboard.php">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="products.php">
                                <i class="fas fa-shopping-cart"></i> Products
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="accounts.php">
                                <i class="far fa-user"></i> Accounts
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="orders.php">
                                <i class="fas fa-shopping-cart"></i> Orders
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link d-block" href="../Logout.php">
                                <?php echo $_SESSION['admin_name']; ?>, <b>Logout</b>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="text-white mt-5 mb-5">Welcome back, <b><?php echo $_SESSION['admin_name']; ?></b></p>
                </div>
            </div>
            <!-- row -->
            <div class="row tm-content-row">
                <!-- <div class="col-sm-12 col-md-12 col-lg-6 col-xl-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block">
                        <h2 class="tm-block-title">Latest Hits</h2>
                        <canvas id="lineChart"></canvas>
                    </div>
                </div> -->
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block">
                        <h2 class="tm-block-title">Top 5 Customers</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">RANKING</th>
                                    <th scope="col">CUSTOMER_NAME</th>
                                    <th scope="col">TIMES_BOUGHT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $dept = array();
                                $result = mysqli_query($conn, "SELECT c.customer_firstname, c.customer_middlename, c.customer_lastname, SUM(oi.quantity) AS TimesBought 
                       FROM customer_details c INNER JOIN orders_details od ON c.customer_id = od.customer_id INNER JOIN order_items oi ON od.order_id = oi.order_id 
                       GROUP BY od.customer_id 
                       ORDER BY TimesBought DESC LIMIT 5");
                                $rowsnum = mysqli_num_rows($result);
                                $x = 0;
                                for ($y = 1; $y <= $rowsnum; $y++) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $dept[] = $row['customer_firstname'];
                                        $row['customer_lastname'];
                                        $row['TimesBought'];

                                ?>
                                        <tr>
                                            <td><b><?php echo $y++; ?></b></td>
                                            <td scope="row" class="text-center"><b><?php echo $row['customer_firstname']; ?>&nbsp;<?php echo $row['customer_lastname']; ?></b></td>
                                            <td><b><?php echo $row['TimesBought']; ?></b></td>


                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller">
                        <h2 class="tm-block-title">Top 5 Order Products</h2>
                        <div id="pieChartContainer">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">RANKING</th>
                                        <th scope="col">PRODUCT_ID</th>
                                        <th scope="col">PRODUCT_NAME</th>
                                        <th scope="col">TOTAL_SALES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $dept = array();
                                    $result = mysqli_query($conn, "SELECT oi.product_id, p.product_name, SUM(oi.quantity) AS TimesBought, (SUM(oi.quantity)*p.product_price) AS TotalSales FROM order_items oi INNER JOIN products p ON oi.product_id = p.product_id GROUP BY oi.product_id ORDER BY TotalSales DESC LIMIT 5");
                                    $rowsnum = mysqli_num_rows($result);

                                    for ($y = 1; $y <= $rowsnum; $y++) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $dept[] = $row['product_id'];
                                            $row['product_name'];
                                            $row['TotalSales'];

                                    ?>
                                            <tr>
                                                <td><b><?php echo $y++; ?></b></td>
                                                <td scope="row" class="text-center"><b><?php echo $row['product_id']; ?></b></td>
                                                <td><b><?php echo $row['product_name']; ?></b></td>
                                                <td><b><?php echo $row['TotalSales']; ?></b></td>

                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-overflow">
                        <h2 class="tm-block-title">Notification List</h2>
                        <div class="tm-notification-items">
                            <div class="media tm-notification-item">
                                <div class="tm-gray-circle"><img src="img/notification-01.jpg" alt="Avatar Image" class="rounded-circle"></div>
                                <div class="media-body">
                                    <p class="mb-2"><b>Jessica</b> and <b>6 others</b> sent you new <a href="#"
                                            class="tm-notification-link">product updates</a>. Check new orders.</p>
                                    <span class="tm-small tm-text-color-secondary">6h ago.</span>
                                </div>
                            </div>    
                            <div class="media tm-notification-item">
                                <div class="tm-gray-circle"><img src="img/notification-01.jpg" alt="Avatar Image" class="rounded-circle"></div>
                                <div class="media-body">
                                    <p class="mb-2"><b>Jessica</b> and <b>6 others</b> sent you new <a href="#"
                                            class="tm-notification-link">product updates</a>. Check new orders.</p>
                                    <span class="tm-small tm-text-color-secondary">6h ago.</span>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div> -->
                <div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title">Orders List</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ORDER_NO</th>
                                    <th scope="col">USERNAME</th>
                                    <th scope="col">PRODUCT</th>
                                    <th scope="col">LOCATION</th>
                                    <th scope="col">QUANTITY</th>
                                    <th scope="col">TOTAL</th>
                                    <th scope="col">ORDERED_DATE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $getorders_query = mysqli_query($conn, "SELECT * FROM orders_details");

                                while ($order = mysqli_fetch_assoc($getorders_query)) {

                                    $getitem = mysqli_query($conn, "SELECT * FROM order_items WHERE order_id = '" . $order['order_id'] . "'");

                                    foreach ($getitem as $item) {

                                        // display the username
                                        $getusername = mysqli_query($conn, "SELECT * FROM customer_details WHERE customer_id = '" . $order['customer_id'] . "' ");

                                        foreach ($getusername as $orderuname) {

                                            // display the username
                                            $getprods = mysqli_query($conn, "SELECT * FROM products WHERE product_id = '" . $item['product_id'] . "' ");

                                            foreach ($getprods as $orderprod) {


                                ?>
                                                <tr>
                                                    <td scope="row" class="text-center"><b><?php echo $order['order_id']; ?></b></td>
                                                    <td><b><?php echo $orderuname['customer_username']; ?></b></td>
                                                    <td><b><?php echo $orderprod['product_name']; ?></b></td>
                                                    <td><b><?php echo $orderuname['customer_complete_address']; ?>,<?php echo $orderuname['customer_city']; ?></b>
                                                    </td>
                                                    <td class="text-center"><b><?php echo $item['quantity']; ?></b></td>
                                                    <td><b><?php echo $order['total_amount']; ?></b></td>
                                                    <td><b><?php echo $order['date_order_placed']; ?></b></td>
                                                </tr>
                                <?php }
                                        }
                                    }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../Sources/js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="../Sources/js/moment.min.js"></script>
    <!-- https://momentjs.com/ -->
    <script src="../Sources/js/Chart.min.js"></script>
    <!-- http://www.chartjs.org/docs/latest/ -->
    <script src="../Sources/js/bootstrap_admin.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <!-- <script src="js/tooplate-scripts.js"></script> -->

</body>

</html>