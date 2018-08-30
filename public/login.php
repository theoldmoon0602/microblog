<?php

require_once __DIR__ . '/../utils.php';

session_start();

$mode = 0;
$error = '';

do {
  if (isset($_POST['login'])) {
    $mode = 1;
  }
  else if (isset($_POST['register'])) {
    $mode = 2;
  }
  else {
    break;
  }


  if (!isset($_POST['username'])) {
    $error = 'username is not specified';
    break;
  }
  if (!isset($_POST['password'])) {
    $error = 'password is not specified';
    break;
  }
  $username = $_POST['username'];
  $password = $_POST['password'];

  if (!preg_match('/^[A-Za-z0-9_]{1,20}$/', $username)) {
    $error = 'invalid username';
    break;
  }

  if ($mode == 1) {
    if (login_user($username, $password)) {
      $_SESSION['username'] = $username;

      header("Location: /index.php");
      exit();
    }
    else {
      $error = 'username and password mismatched';
      break;
    }
  }
  else {
    try {
      register_user($username, $password);
      $_SESSION['username'] = $username;

      header("Location: /index.php");
      exit();
    }
    catch(Exception $e) {
      $error = 'failed to register';
      break;
    }
  }
} while(false);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <style>
    body {
      width: 1280px;
      margin: 0 auto;
      padding-top: 50px;
    }

    form {
      width: 800px;
      border: 2px solid #ccc;
      padding: 5px 10px;
      margin: 0 auto;
    }
  </style>
</head>
<body>
  <h1>Microblog</h1>

  <p><?= $error; ?></p>

  <form action="/login.php" method="post">
    <p><input type="text" name="username" placeholder="username" require /></p>
    <p><input type="text" name="password" placeholder="password" require /></p>

    <p><input type="submit" name="login" value="Login" /> <input type="submit" name="register" value="Register" /></p>
  </form>


</body>
</html>
