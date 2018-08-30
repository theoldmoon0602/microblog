<?php

function connect() {
  $pdo = new PDO('sqlite:' . __DIR__ . '/database.db');
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $pdo;
}

function register_user($username, $password) {
  $pdo = connect();
  $stmt = $pdo->prepare('insert into users(username, password) values (:username, :password)');
  $stmt->execute([
    ':username' => $username,
    ':password' => $password,
  ]);
}

function login_user($username, $password) {
  $pdo = connect();
  $r = $pdo->query("select username from users where username = '$username' and password = '$password'")->fetchAll();
  if (count($r) === 0) {
    return false;
  }
  return true;
}

function post($user, $content) {
  $pdo = connect();
  $stmt = $pdo->prepare('insert into posts(user, content) values (:user, :content)');
  $stmt->execute([
    ':user' => $user,
    ':content' => $content
  ]);
}

function recent_posts($n = 10) {
  $pdo = connect();
  $stmt = $pdo->prepare('select * from posts order by id desc limit :n');
  $stmt->execute([
    ':n' => $n,
  ]);
  return $stmt->fetchAll();
}
