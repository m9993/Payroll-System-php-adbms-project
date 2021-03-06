<?php
require_once "includes/oracle_php_connection.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["u_login"])) {
      $sql="select u_email,u_password,u_role from login,role where login.u_id=role.u_id";
      if(count( GetArray($sql))==0){
        $_SESSION['msg_type']='danger';
        $_SESSION['msg']='Login failed. There is no user in the database!';
      }else{
        $sql="select users.u_id, u_name,u_email,u_password,u_role from users,login,role where login.u_id=role.u_id and users.u_id=login.u_id and u_email='".$_POST['u_email']."' and u_password='".$_POST['u_password']."'";
        $n=GetArray($sql);
        if(count($n)<=0){
          $_SESSION['msg_type']='danger';
          $_SESSION['msg']='Email or password is worng. Please try again!';
        }else{
          $_SESSION['u_name']=$n[0]['U_NAME'];
          $_SESSION['u_id']=$n[0]['U_ID'];
          if($n[0]['U_ROLE']=='admin'){header('Location: adminHome.php');}
          if($n[0]['U_ROLE']=='employee'){header('Location: employeeHome.php');}
          
        }
      }

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

    <title>Login</title>
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


        <form method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input required name='u_email' type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input required name='u_password' type="password" class="form-control" id="exampleInputPassword1">
          </div>
          <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
          </div>
          <button name='u_login' type="submit" class="btn btn-primary">Submit</button>
        </form>
        
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