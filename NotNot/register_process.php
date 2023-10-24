<?php

$db = new PDO('mysql:host=localhost;dbname=todolist', 'root', '');

function registerUser($db, $namadepan, $namabelakang, $username, $password, $tanggal, $gender) {
  $password = password_hash($password, PASSWORD_DEFAULT);
  $sql = 'INSERT INTO datauser (namadepan, namabelakang, username, password, tanggal, gender) VALUES (?, ?, ?, ?, ?, ?)';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(1, $namadepan);
  $stmt->bindParam(2, $namabelakang);
  $stmt->bindParam(3, $username);
  $stmt->bindParam(4, $password);
  $stmt->bindParam(5, $tanggal);
  $stmt->bindParam(6, $gender);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    return true;
  } else {
    return false;
  }
}

if (isset($_POST['register'])) {
  $namadepan = $_POST['namadepan'];
  $namabelakang = $_POST['namabelakang'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $tanggal = $_POST['tanggal'];
  $gender = $_POST['gender'];

  if (registerUser($db, $namadepan, $namabelakang, $username, $password, $tanggal, $gender)) {
    header('Location: login.php');
  } else {
    $error = 'Register gagal';
  }
}

?>