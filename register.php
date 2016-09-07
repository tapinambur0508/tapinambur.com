<?php 
  require_once 'app/include/function.php';

  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  if ($name == '' || $email == '' || $password == '') {
  	echo 'nullPointerException';
    exit;
  }

  $users = getUsers();

  var_dump($users);

  foreach ($users as $user) {
    if ($user['name'] == $name || $user['email'] == $email) {
      echo 'fail';
      exit;
    } 
  }

  $message = 'Для підтвердження реєстрації на сайті tapinambur.com, введіть наступний код \r\n'.code.'\r\nДякую';
  $to = $email;
  $from = 'tapinambur@gmai.com';
  $subject = 'Дякуємо Вам за реєстрацію на сайті tapinambur';
  $subject = '=?utf-8?B?'.base64_encode($subject).'?=';
  $headers = 'From:  $from\r\nReply-to: $from\r\nContent-type: text/plain; charset=utf-8\r\n';

  mail($to, $subject, $message, $headers);
  //setUsers($name, $email, $password);
  echo 'success'; 
?>