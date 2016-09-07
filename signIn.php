<?php
  require_once 'app/include/function.php';

  if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $name = getUserName($email, md5($password));
    echo $name;
    
    if (isset($name)) {
      $cookie_name = "login";
      $cookie_value = $name;
      setcookie($cookie_name, $cookie_value);
    } else {
      echo(
            "<h3 align='center' style='color: #FF0000;'>Неправильний email або пароль</h3>"
          );
    }
  }
?>

<!DOCTYPE HTML>
<html>
  <head>
      <title>Sign in</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="public/css/style.css" rel="stylesheet">
      <link href="public/css/sign-style.css" rel="stylesheet">
      <link href="public/css/bootstrap.css" rel="stylesheet">
      <link href="public/css/font-awesome.css" rel="stylesheet">

      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
  
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> 
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <script src="public/js/bootstrap.js"></script>
  </head>
  <body>
    <div class="container" id="form">
      <form class="form-signin" action="" method="POST">
        <h2 class="form-signin-heading" align="center">tapinambur - Вхід</h2>
        <input type="email" name="email" class="form-control" placeholder="Email address" required autofocus>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <input class="btn btn-lg btn-success btn-block" type="submit" value="Увійти">
        <a class="btn btn-lg btn-primary btn-block" type="button" href="/signUp.php">Реєстрація</a>
      </form>
    </div>
  </body>
</html>