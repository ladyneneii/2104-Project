<?php
include '../Config/db_config.php';
session_start();

$conn = OpenCon();

    //Fetching All Products
    
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);
    $array_products = [];
    if ($result->num_rows > 0) {
        $array_products = $result->fetch_all(MYSQLI_ASSOC);
    }

    // Deleteing Products
    if (isset($_GET['id'])) {
      $id=$_GET['id'];
      $result = mysqli_query($conn, "DELETE FROM products WHERE product_id=$id");
      header('location:products.php');
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
          <h1 class="tm-site-title mb-0">Products</h1>
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
              <a class="nav-link active" href="products.php">
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
              <a class="nav-link d-block" href="Logout.php">
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
                    
                    <th scope="col">PRODUCT NAME</th>
                    <th scope="col">DESCRIPTION</th>
                    <th scope="col">PRICE</th>
                    <th scope="col">QUANTITY</th>
                    <th scope="col">STOCK</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                    <?php if(!empty($array_products)) { ?>
                        <?php foreach($array_products as $user) {?>
                            <tr>

                                <td class="tm-product-name"><?php echo $user['product_name']; ?></td>
                                <td ><?php echo $user['product_description']; ?></td>
                                <td><?php echo number_format($user['product_price']); ?></td>
                                <td><?php echo $user['product_quantity']; ?></td>
                                <td><?php echo $user['product_stocks']; ?></td>
                                <td>
                                  <a href="products.php?id=<?php echo $user['product_id'];?>" class="tm-product-delete-link">
                                    <i class="far fa-trash-alt tm-product-delete-icon"></i>
                                  </a>
                                </td>
                                <td>
                                  <a href="edit_product.php?id=<?php echo $user['product_id'];?>" class="tm-product-delete-link" >
                                    <i class="fas fa-pencil-alt tm-product-delete-icon"></i>
                                  </a>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- table container -->
            <a
              href="add_product.php"
              class="btn btn-primary btn-block text-uppercase mb-3">Add new product</a>
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