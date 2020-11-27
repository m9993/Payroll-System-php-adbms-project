<?php
require_once "includes/oracle_php_connection.php";

session_start();
if(!isset($_SESSION['u_id']) && !isset($_SESSION['u_name'])){
  header("Location: index.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["u_login"])) {
        $_SESSION['msg_type']='warning';
        $_SESSION['msg']='warnxxzzxing';

    }
}



?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

    <title>Admin</title>
  </head>
  <body>
    <div class="container mt-5">
        <h3 class="text-danger mb-5">Payroll System</h3>


        <?php if (isset($_SESSION["msg"])) { ?>
          <div class="alert alert-<?=$_SESSION['msg_type']?>" role="alert">
              <?php
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
                unset($_SESSION['msg_type']);
              ?>
          </div>

        <?php } ?>
        
        <div class="float-right h6">
          <a href="" class="mr-5">
            <i class="fas fa-edit"></i>Profile
          </a>
          <a href="logout.php" class="text-danger">
            <i class="fas fa-power-off  pr-1"></i>Logout
          </a>
        </div>

        <div class="cart">
          <h5>Admin</h5>
          <h6 class="text-muted">Welcome, <?php echo $_SESSION['u_name']?> </h6>
          <div class="cart-body border text-uppercase alert-primary">
            <a class="mx-3" href="#">Home</a>
            <a class="mx-3" href="#">Working Point</a>
            <a class="mx-3" href="#">Salary</a>
            <a class="mx-3" href="#">Payment</a>
            <a class="mx-3" href="#">Payroll</a>
            <a class="mx-3" href="#">Invoice</a>
          </div>
        </div>

       
        
    </div>


























    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>