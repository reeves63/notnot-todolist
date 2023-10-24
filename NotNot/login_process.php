<?php
session_start();

$db = new PDO('mysql:host=localhost;dbname=todolist', 'root', '');

function loginUser($db, $username, $password) {
  $sql = 'SELECT * FROM datauser WHERE username = ?';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(1, $username);
  $stmt->execute();
  $user = $stmt->fetch();

  if (!$user) {
    return false;
  }

  if (!password_verify($password, $user['password'])) {
    return false;
  }

  $_SESSION['user'] = $user;

  return true;
}

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if (loginUser($db, $username, $password)) {
    header('Location: index.php');
  } else {
    header('Location: login.php?error=1');
  }
}
?>
