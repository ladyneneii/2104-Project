<?php 
session_start();
include 'Config/db_config.php';
$conn = OpenCon();


$gender_typ = "SELECT * FROM `ref_gender_code`";
$all_gen = mysqli_query($conn, $gender_typ);


if (isset($_POST['submit'])) {

    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $mname = mysqli_real_escape_string($conn, $_POST['mname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['c_password']);
    $gender = mysqli_real_escape_string($conn, $_POST['gen_type']);
    // $user_typ = mysqli_real_escape_string($conn, $_POST['u_type']);


    $select = " SELECT * FROM `customer_details` WHERE `customer_username` = '$username' 
    && `customer_password` = '$pass'";

$result = mysqli_query($conn, $select);

if (mysqli_num_rows($result) > 0) {
    $error[] = 'username already exist!';
} else if ($pass != $cpass) {
    $error[] = 'password did not match!';
} else {
        $insert_user = " INSERT INTO customer_details
        (user_category_id, customer_firstname, customer_middlename, 
        customer_lastname, customer_contact_no, customer_age, customer_gender_id, 
        customer_complete_address, customer_city, customer_username, customer_password) 
        
        VALUES ('1','$fname','$mname','$lname','$contact',
        '$age','$gender','$address','$city','$username','$pass') ";

$RUN = mysqli_query($conn, $insert_user);
      if ($RUN) {
      echo '<script> alert("Data Saved!"); </script>';
      header('Location: login.php');
      }
      else{
      echo '<script> alert("Data not Saved!"); </script>';
      }
}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="sources/css/style1.css">
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"> -->
  <!-- JavaScript Bundle with Popper -->

</head>

<body>
  <div class="navbar">
    <a href="">
    <img src="Images/logo.jpg" width="13%">
    </a>


  </div>

  <div class="wrapper">
    <div class="container">
      <form action="" method="POST" autocomplete="off">

        <?php
        if (isset($error)) {
          foreach ($error as $error) {
            echo '<span class="error-msg">' . $error . '</span> <br>';
          };
        };
        ?>

        <div class="title">Register</div>

        <div class="input-form">

        <div class="section-1">
                                <div class="items">
                                    <label for="fname" class="label">Firstname*</label>
                                    <input type="text" name="fname" class="input" placeholder="ex. Juan Crisostomo" required>
                                </div>
                            </div>

                            <div class="section-1">
                                <div class="items">
                                    <label for="mname" class="label">Middlename*</label>
                                    <input type="text" name="mname" class="input" placeholder="ex. Magsalin" required>
                                </div>
                            </div>

                            <div class="section-1">
                                <div class="items">
                                    <label for="lname" class="label">Lastname*</label>
                                    <input type="text" name="lname" class="input" placeholder="ex. Ibarra" required>
                                </div>
                            </div>

                            <div class="section-1">
                                <div class="items">
                                    <label for="contact" class="label">Contact Number*</label>
                                    <input type="text" name="contact" class="input" placeholder="ex. 0912345..." required>
                                </div>
                            </div>

                            <div class="section-2">
                                <div class="items">
                                    <label for="age" class="label">Age*</label>
                                    <input type="number" name="age" class="input" placeholder="" required>
                                </div>
                            </div>

                            <div class="section-2">
                                <div class="items">
                                    <label for="gender_type" class="label">Select gender</label>
                                    <select name="gen_type" id="sel-user" class="sel-user">
                                    <option value="0" selected>-Select-</option>
                                        <?php
                                        // use a while loop to fetch data
                                        // from the $all_categories variable
                                        // and individually display as an option
                                        while ($category = mysqli_fetch_array($all_gen, MYSQLI_ASSOC)) :
                                        ?>
                                            <option  value="<?php echo $category["gender_id"];
                                                                    // The value we usually set is the primary key
                                                                    ?>"><?php echo $category["gender_type"];
                                            // To show the category name to the user
                    ?></option>
                                        <?php
                                        endwhile;

                                        // While loop must be terminated
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="section-2">
                                <div class="items">
                                    <label for="address" class="label">Address</label>
                                    <input type="text" name="address" class="input" placeholder="ex. 123 Main Street Brgy Tipolo" required>
                                </div>
                            </div>

                            <!-- <div class="section-2">
            <div class="items">
              <label for="password" class="label">Zipcode</label>
              <input type="passwords" name="password" class="input" placeholder="ex. 6000" required>
            </div>
          </div> -->

                            <div class="section-2">
                                <div class="items">
                                    <label for="city" class="label">City</label>
                                    <input type="text" name="city" class="input" placeholder="ex. Lapu-Lapu" required>
                                </div>
                            </div>


                            <div class="section-2">
                                <div class="items">
                                    <label for="username" class="label">Username</label>
                                    <input type="passwords" name="username" class="input" placeholder="ex. jane" required>
                                </div>
                            </div>

                            <div class="section-2">
                                <div class="items">
                                    <label for="password" class="label">Password</label>
                                    <input type="passwords" name="password" class="input" placeholder="ex. xxxxxx" required>
                                </div>
                            </div>

                            <div class="section-2">
                                <div class="items">
                                    <label for="c_password" class="label">Confirm Password</label>
                                    <input type="passwords" name="c_password" class="input" placeholder="ex. xxxxxx" required>
                                </div>
                            </div>

                        </div>


          <button type="submit" name="submit" class="submit_btn">Sign Up now</button>

          <!-- <button type="button" style="text-align: center;text-align: center; width: 100%;background-color: #fff;border: none;padding: 10px;
          font-size: 14px;" onclick="location.href='cart.html'">Return to cart</button> -->
          <br>
          <br>
          <p><b>
          <center>already have an account?</center>
                            </b>
                        <div class="rebtn" onclick="location.href='login.php'">Login</div>
          </p>
        </div>
      </form>
    </div>
  </div>
</body>

</html>