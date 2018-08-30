<?php

require_once __DIR__ . '/../utils.php';

session_start();

if (!isset($_SESSION['username'])) {
  header("Location: /login.php");
  exit;
}

if (isset($_POST['content'])) {
  post($_SESSION['username'], $_POST['content']);
}

$posts = recent_posts();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Microblog</title>
  <style>
    body {
      width: 1280px;
      margin: 0 auto;
      padding-top: 50px;
    }

    form,.post {
      width: 800px;
      border: 2px solid #ccc;
      padding: 5px 10px;
      margin: 0 auto;
    }
  </style>
</head>
<body>
  <h1>Microblog</h1>

  <form action="/index.php" method="post">
    <p><textarea id="" name="content" cols="30" rows="10"></textarea></p>
    <p><input type="submit" value="post"> as <?= $_SESSION['username']; ?></p>
  </form>

  <form action="/logout.php" method="post" name="logout">
    <a href="#" onclick="document.forms.logout.submit()">Logout</a>
  </form>

  <?php foreach ($posts as $p) { ?>
  <div class="post">
    <h3><?= $p['user'] ?></h3>
    <p><?= htmlspecialchars($p['content']); ?></p>
  </div>
  <?php } ?>

</body>
</html>
