<?php
include('php/login.php');
if(isset($_SESSION['login_user'])){
  header("location: userpage.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Invoicing System</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
    .navbar-header {
      height: 60px;
    }
    .navbar-brand {

      padding-top: 0;
      padding-bottom: 0;
      line-height: 60px;
      font-size: 40px;
    }

    .nav.navbar-nav > li > a {
      padding-top: 20px;
      padding-bottom: 20px;
    }

    .demo-container{
      width: 270px;
      height: 200px;
      margin-top: 200px;
      margin-left: 500px;
      align-items: center;
    }
  </style>
</head>
<body>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>

  <nav class="navbar navbar-expand-sm bg-primary navbar-dark">
    <a href = "index.php" class="navbar-brand">Invoicing System</a>
  </nav>

  <div class="demo-container">
    <form action="" method="POST">
     <div class = "form-group">
      <label for = "name">Username</label>
      <input placeholder = "Username" name = "username" type = "text" class = "form-control" required />
    </div>
    <div class = "form-group">      
      <label for = "pwd">Password</label>
      <input name = "password" type = "password" placeholder = "Password" class = "form-control" required />          
    </div>
    <input type="submit" class="btn btn-primary" name="submit" value="Login"/>
    <span><?php echo $error; ?></span>
  </form>
</div>

</body>
</html>