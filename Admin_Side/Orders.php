<?php
include '../Config/db_config.php';
session_start();

$conn = OpenCon();

    //Fetching All Products
    
    // $sql = "SELECT * FROM products";
    // $result = $conn->query($sql);
    // $array_products = [];
    // if ($result->num_rows > 0) {
    //     $array_products = $result->fetch_all(MYSQLI_ASSOC);
    // }

    // Deleteing Products
    // if (isset($_GET['id'])) {
    //   $id=$_GET['id'];
    //   $result = mysqli_query($conn, "DELETE FROM products WHERE product_id=$id");
    //   header('location:products.php');
    // }

    // SELECT od.order_id , pd.order_id, rf.payment_status_description FROM payment_details pd INNER JOIN orders_details od ON od.order_id = pd.order_id INNER JOIN ref_payment_status_code rf ON rf.payment_status_code = pd.payment_status_code GROUP BY od.order_id

    // SELECT od.order_id , pd.order_id FROM payment_details pd INNER JOIN orders_details od ON od.order_id = pd.order_id GROUP BY od.order_id

    // UPDATE `orders_details` SET `order_status_code` = '1' WHERE `orders_details`.`order_id` = 14;
    // Order Conformation
    if (isset($_GET['id'])) {
      $id=$_GET['id'];
      $result = mysqli_query($conn, "DELETE FROM products WHERE product_id=$id");
      header('location:orders.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Admin Products</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto:400,700"
    />
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="../sources/css/fontawesome.min.css" />
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="../sources/css/bootstrap_admin.min.css" />
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="../sources/css/style_ad1.css">
    <!--
	Product Admin CSS Template
	https://templatemo.com/tm-524-product-admin
	-->
  </head>

  <body>
    <nav class="navbar navbar-expand-xl">
      <div class="container h-100">
        <a class="navbar-brand" href="../Admin_Side/Products.php">
          <h1 class="tm-site-title mb-0">Orders</h1>
        </a>
        <button
          class="navbar-toggler ml-auto mr-0"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <i class="fas fa-bars tm-nav-icon"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto h-100">
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php">
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
                            <a class="nav-link active" href="">
                            <i class="fas fa-shopping-cart"></i> Orders
                            </a>
                        </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link d-block" href="../Logout.php">
              <?php echo$_SESSION['admin_name'];?>, <b>Logout</b>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container mt-5">
      <div class="row tm-content-row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 tm-block-col">
          <div class="tm-bg-primary-dark tm-block tm-block-products">
            <div class="tm-product-table-container">
              <table class="table table-hover tm-table-small tm-product-table">
                <thead>
                  <tr>
                    
                    <th scope="col">ORDER_ID</th>
                    <th scope="col">CUSTOMER_USERNAME</th>
                    <th scope="col">PRODUCT_NAME</th>
                    
                    <th scope="col">TOTAL_AMOUNT</th>
                    <th scope="col">COURIER</th>
                    <th scope="col">ORDER_STATUS</th>
                    <th scope="col">DELIVERY_STATUS</th>
                    <th scope="col">PAYMENT_STATUS</th>
                    
                    

                  </tr>
                </thead>
                <tbody>
                    

                            <?php
                            $query = "SELECT od.order_id, cd.customer_username, prod.product_name, od.total_amount, rsc.shipment_courier_name, 
                            ros.order_status_description,rf.payment_status_description, rds.delivery_status_desc
                            FROM orders_details od
                            INNER JOIN order_items oi ON oi.order_id = od.order_id
                            INNER JOIN customer_details cd ON cd.customer_id = od.customer_id
                            INNER JOIN products prod ON prod.product_id = oi.product_id
                            INNER JOIN ref_order_status_code ros ON ros.order_status_code = od.order_status_code
                            INNER JOIN payment_details pd ON pd.order_id = od.order_id
                            INNER JOIN shipment_details sd ON sd.payment_id = pd.payment_id
                            INNER JOIN ref_delivery_status rds ON rds.delivery_status_code = sd.delivery_status_code
                            INNER JOIN ref_shipment_courier rsc ON rsc.shipment_courier_code = sd.shipment_courier_code
                            INNER JOIN ref_payment_status_code rf ON rf.payment_status_code = pd.payment_status_code";
                            $getorders_query = mysqli_query($conn,$query);
                                   
                                    while($order = mysqli_fetch_assoc($getorders_query)){

                                ?>
                            <tr>

                                <td class="tm-product-name"><b><?php echo $order['order_id']; ?></b></td>
                                <td ><b><?php echo $order['customer_username']; ?></b></td>
                                <td ><b><?php echo $order['product_name']; ?></b></td>
                                <!-- <td><b><?php echo $item['quantity']; ?></b></td> -->
                                <td><b><?php echo $order['total_amount']; ?></b></td>
                                <td><b><?php echo $order['shipment_courier_name']; ?></b></td>
                                <td><b><?php echo $order['order_status_description']; ?></b></td>

                                <td style="background: white;">
                                
                                  <a href="orders.php?id=<?php echo $order['order_id'];?>" >
                                  <b><?php echo $order['delivery_status_desc']; ?></b>
                                  </a>
                                </td>
                                <td style="background: white;">
                                  <a href="orders.php?id=<?php echo $order['order_id'];?>" style="color: #09b709;">
                                  <b><?php echo $order['payment_status_description']; ?></b>
                                  </a>
                                </td>
                            </tr>
                                    <?php }
                                  
                                 ?>
                </tbody>
              </table>
            </div>
            <!-- table container -->
            <!-- <a
              href="add_product.php"
              class="btn btn-primary btn-block text-uppercase mb-3">Add new product</a> -->
          </div>
        </div>
      </div>
    </div>

    <script src="../Sources/js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="../Sources/js/bootstrap_admin.min.js"></script>
    <!-- https://getbootstrap.com/ -->
  </body>
</html>