<?php
include '../Config/db_config.php';
session_start();

$conn = OpenCon();

    if (isset($_GET['id'])) {
      $id=$_GET['id'];
      $query=mysqli_query($conn,"SELECT * FROM products WHERE product_id='$id'");
      while ($row = mysqli_fetch_assoc($query)) {
      
      $pname=$row['product_name'];
      $descrip=$row['product_description'];
      $price=$row['product_price'];
      $stock=$row['product_quantity'];

    }
    }

    //Updating Product

    if (isset($_POST['UpdateProduct'])) {
        $ID=$_POST['pro_id'];
      $pro_name=$_POST['pro_name'];
      $pro_descrip=$_POST['pro_descrip'];
      $pro_price=$_POST['pro_price'];
      $pro_qty=$_POST['pro_qty'];

      $pro_stock1 = "In Stock";
      $pro_stock2 = "Out of Stock";

      // $image_name = $_FILES['p_image']['name'];
      // $image_temp = $_FILES['p_image']['tmp_name'];
      // $time = time();
      // $path = "images/".$time.$image_name;

      if($pro_qty > 0)
      {
      $query="UPDATE `products` SET `product_name`='$pro_name',`product_description`='$pro_descrip',`product_price`='$pro_price',`product_quantity`='$pro_qty',`product_stocks`='$pro_stock1' WHERE product_id=$id";
      $RUN=mysqli_query($conn,$query);
      if ($RUN) {
      echo '<script> alert("Data Saved!"); </script>';
      header('Location: products.php');
      }
      else{
      echo '<script> alert("Data not Saved!"); </script>';
      }
     } else
     {
     $query="UPDATE `products` SET `product_name`='$pro_name',`product_description`='$pro_descrip',`product_price`='$pro_price',`product_quantity`='$pro_qty',`product_stocks`='$pro_stock2' WHERE product_id=$id";
     $RUN=mysqli_query($conn,$query);
     if ($RUN) {
     echo '<script> alert("Data Saved!"); </script>';
     header('Location: products.php');
     }
     else{
     echo '<script> alert("Data not Saved!"); </script>';
     }
    } 
    // else
    // {
      
    //   $query="UPDATE `products` SET `product_name`='$pro_name',`product_descrip`='$pro_descrip',`product_price`='$pro_price',`product_quantity`='$pro_stock' WHERE product_id=$ID";
    //   $RUN=mysqli_query($conn,$query);
    //   if ($RUN) {
    //   echo '<script> alert("Data Saved!"); </script>';
    //   header('Location: products.php');
    //   }
    //   else{
    //   echo '<script> alert("Data not Saved!"); </script>';
    //   } 
    // }
    }
?>

<!DOCTYPE html>
  <html lang="en">
    
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0"
      />
      <meta http-equiv="X-UA-Compatible" content="ie=edge" />
      <title>
        Admin Edit Product
      </title>
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700"
      />
      <!-- https://fonts.google.com/specimen/Roboto -->
      <link rel="stylesheet" href="../sources/css/fontawesome.min.css" />
      <!-- https://fontawesome.com/ -->
      <link rel="stylesheet" href="../sources/css/bootstrap_admin.min.css" />
      <!-- https://getbootstrap.com/ -->
      <link rel="stylesheet" href="../sources/css/style_ad1.css">
      <!-- Product Admin CSS Template https://templatemo.com/tm-524-product-admin
      -->
    </head>
    
    <body>
      <nav class="navbar navbar-expand-xl">
        <div class="container h-100">
          <a class="navbar-brand" href="index.html">
            <h1 class="tm-site-title mb-0">
              Product Admin
            </h1>
          </a>
          <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse"
          data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
          aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars tm-nav-icon">
            </i>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto h-100">
              <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                  <i class="fas fa-tachometer-alt">
                  </i>
                  Dashboard
                  <span class="sr-only">
                    (current)
                  </span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="products.php">
                  <i class="fas fa-shopping-cart">
                  </i>
                  Products
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="accounts.php">
                  <i class="far fa-user">
                  </i>
                  Accounts
                </a>
              </li>
            </ul>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link d-block" href="login.php">
                  <?php echo$_SESSION[ 'admin_name'];?>
                    ,
                    <b>
                      Logout
                    </b>
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
                  <h2 class="tm-block-title d-inline-block">
                    Edit Product
                  </h2>
                </div>
              </div>
              <!-- <div class="row tm-edit-product-row"> -->
              <!-- <div class="col-xl-6 col-lg-6 col-md-12"> -->
              <?php ?>
                <form action="edit_product.php?id=<?php echo $id;?>" method="POST" enctype="multipart/form-data"
                class="tm-edit-product-form">
                  <div class="form-group mb-3">
                    <label for="name">
                      Product Name
                    </label>
                    <input id="name" name="pro_name" type="text" value="<?php echo $pname;?>"
                    class="form-control validate" required />
                  </div>
                  <div class="form-group mb-3">
                    <label for="description">
                      Description
                    </label>
                    <textarea id="descrip" name="pro_descrip" class="form-control validate" rows="3" required><?php echo $descrip;?>
                    </textarea>
                  </div>
                  <div class="row">
                    <div class="form-group mb-3 col-xs-12 col-sm-6">
                      <label for="price">
                        Price
                      </label>
                      <input id="price" name="pro_price" type="number" min=0 value="<?php echo $price;?>"
                      class="form-control validate" data-large-mode="true" required />
                    </div>
                    <div class="form-group mb-3 col-xs-12 col-sm-6">
                      <label for="stock">
                        Units In Stock
                      </label>
                      <input id="stock" name="pro_qty" value="<?php echo $stock;?>" type="number"
                      min=0 class="form-control validate" required />
                    </div>
                  </div>
                  <!-- </div> -->
                  <!-- <div class="col-xl-6 col-lg-6 col-md-6 mx-auto mb-4">
                  <img class="tm-avatar img-responsive" src="<?php if(isset($img)){echo $img;} else{echo"images/no_image.jpg";} ?>" id="no_img">
                  <div class="fileupload btn">
                  <center><span class="col-lg-6 col-md-6 btn-text btn-primary btn-block text-uppercase">Change</span></center>
                  <input class="upload" type="file" id="input_file" name="p_image" accept="image/png,image/jpeg,image/jpg">
                  </div>
                  </div> -->
                  <input type="hidden" name="pro_id" value="<?php echo $id;?>">
                  <div class="col-12">
                    <button type="submit" name="UpdateProduct" class="btn btn-success btn-block text-uppercase">
                      Update Product
                    </button>
                  </div>
                </form>
                <!-- </div> -->
            </div>
          </div>
        </div>
      </div>
      <script src="../sources/js/jquery-3.3.1.min.js">
      </script>
      <!-- https://jquery.com/download/ -->
      <script src="../sources/js/bootstrap_admin.min.js">
      </script>
      <!-- https://getbootstrap.com/ -->
      <script>
        $('#input_file').change(function() {
          if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload = function(x) {
              $('#no_img').attr('src', x.target.result);
            }
          }
        });
      </script>
    </body>
  
  </html>