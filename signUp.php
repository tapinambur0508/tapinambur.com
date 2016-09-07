<?php
  require_once 'app/include/function.php';

  if (isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password'])) {
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    setUsers($login, $email, $password);

    $cookie_name = "login";
    $cookie_value = $login;
    setcookie($cookie_name, $cookie_value);

    header("Location: /"); 
  }
?>

<!DOCTYPE HTML>
<html>
  <head>
      <title>Sign Up</title>
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
      <script src="http://malsup.github.com/jquery.form.js"></script> 
      <script src="public/js/bootstrap.js"></script>
  </head>
  <body>
    <div class="container" id="form">
      <form class="form-signin" action="" method="POST" id="myForm">
        <h2 class="form-signin-heading" align="center">Реєстрація</h2>
        <input type="text" name="login" class="form-control" placeholder="Login" required autofocus>
        <input type="text" name="check_login" class="form-control" value="Користувач з таким логіном вже існує" disabled>
        <input type="email" name="email" class="form-control" placeholder="Email address" required>
        <input type="text" name="check_email" class="form-control" value="Користувач з таким email вже існує" disabled>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <input class="btn btn-lg btn-success btn-block" type="button" value="Зареєструватися" name="send">
      </form>
    </div>
  </body>

  <script>
    $("document").ready(function () {
      $("#form input[name='check_login']").hide();
      $("#form input[name='check_email']").hide();

      $("#form input[name='login']").blur(function () {
        var login = $(this).val();

        if (login.length != 0) {
          $.ajax({
            url: "checkLogin.php",
            type: "POST",
            data: {"login" : login}
          }).done(function (data) {
            if (data.length > 0) {
              $("#form input[name='check_login']").show();
            } else {
              $("#form input[name='check_login']").hide();
            }
          });
        }
      });  

      $("#form input[name='email']").blur(function () {
        var email = $(this).val();

        if (email.length != 0) {
          $.ajax({
            url: "checkEmail.php",
            type: "POST",
            data: {"email" : email}
          }).done(function (data) {
            alert(data);
            alert(data.length);
            if (data.length > 0) {
              $("#form input[name='check_email']").show();
            } else {
              $("#form input[name='check_email']").hide();
            }
          });
        }
      });  
    });
  </script>
</html>