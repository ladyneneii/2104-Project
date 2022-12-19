<?php 
include '../Config/db_config.php';
session_start();

$conn = OpenCon();

  //Fetching All Products type
    
  $sql = "SELECT * FROM ref_product_type";
  $result = $conn->query($sql);
  $array_prod_typ = [];
  if ($result->num_rows > 0) {
      $array_prod_typ = $result->fetch_all(MYSQLI_ASSOC);
  }

  //Insert new product type
  if (isset($_POST['AddProdTyp'])) {
    $desc = $_POST['desc'];


    $query = "INSERT INTO `ref_product_type`(`product_type_description`) VALUES ('$desc')";
  $RUN = mysqli_query($conn, $query);
  if ($RUN) {
    echo '<script> alert("Data Saved!"); </script>';
          header('Location: add_product.php');
      }
      else {
    echo '<script> alert("Data not Saved!"); </script>';
      }


     
}
?>

<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Add Product</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700" />
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
                <a class="navbar-brand" href="index.html">
                    <h1 class="tm-site-title mb-0">Product Admin</h1>
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
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link d-block" href="login.php">
                                <?php echo$_SESSION['admin_name'];?>, <b>Logout</b>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        

        <div class="container tm-mt-big tm-mb-big">
            <div class="row">
                <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12 mx-auto">
                    <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="tm-block-title d-inline-block">Add Product Type</h2>
                            </div>
                        </div>

                        <div class="tm-product-table-container">
              <table class="table table-hover tm-table-small tm-product-table">
                <thead>
                  <tr>
                  <th scope="col">PRODUCT TYPE CODE</th>
                    <th scope="col">PRODUCT TYPE NAME</th>
                    <th scope="col"></th>
                    
                  </tr>
                </thead>
                <tbody>
                    <?php 
                    //    Deleteing Products
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $result = mysqli_query($conn, "DELETE FROM `ref_product_type` WHERE `product_type_code` = $id");
        if ($result) {
          echo '<script> alert("Deleted!"); </script>';
                header('Location: add_prod_typ.php');
            }
            else {
          echo '<script> alert("Not Deleted!"); </script>';
            }
      }
                    ?>
                    <?php if(!empty($array_prod_typ)) { ?>
                        <?php foreach($array_prod_typ as $typ) {?>
                            <tr>
                            <td class="tm-product-name"><?php echo $typ['product_type_code']; ?></td>
                                <td class="tm-product-name"><?php echo $typ['product_type_description']; ?></td>
                                <td>
                                  <a href="add_prod_typ.php?id=<?php echo $typ['product_type_code'];?>" class="tm-product-delete-link">
                                    <i class="far fa-trash-alt tm-product-delete-icon"></i>
                                  </a>
                                </td>
                                
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
              </table>
            </div>

                        <form action="add_prod_typ.php" method="POST" enctype="multipart/form-data"
                            class="tm-edit-product-form">
                            <div class="form-group mb-3">
                                <label for="name">Type Description</label>
                                <input id="desc" name="desc" type="text" class="form-control validate" required/>
                            </div>

                            <div class="col-12">
                                <button type="submit" name="AddProdTyp" class="btn btn-primary btn-block text-uppercase">Add Type</button>
                            </div>
                        </form>
                        <br>
                        <div class="col-12">
                        <button class="btn btn-info btn-block text-uppercase" "><a href="add_product.php" style="color: black;">Back</a></button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <script src="../sources/js/jquery-3.3.1.min.js"></script>
        <!-- https://jquery.com/download/ -->
        <script src="../sources/js/bootstrap_admin.min.js"></script>
        <!-- https://getbootstrap.com/ -->

    </body>

    </html>