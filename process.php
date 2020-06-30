<?php

session_start();

$mysqli = new mysqli('std-mysql', 'std_972', 'dapa0803', 'std_972') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$name = '';
$location = '';

if (isset($_POST['save'])) {
   $name = $_POST['name'];
   $location = $_POST['location'];

   $mysqli->query("INSERT INTO data2 (name, location) VALUES('$name','$location')") or die($mysqli->error);

   $_SESSION['message'] = "Пользователь был добавлен!";
   $_SESSION['msg_type'] = "success";

   header("location: crud.php");
}


if (isset($_GET['delete'])) {
   $id = $_GET['delete'];
   $mysqli->query("DELETE FROM data2 WHERE id=$id") or die($mysqli->error);

   $_SESSION['message'] = "Пользователь был удален!";
   $_SESSION['msg_type'] = "danger";

   header("location: crud.php");
}

if (isset($_GET['edit'])) {
   $id = $_GET['edit'];
   $update = true;
   $result = $mysqli->query("SELECT * FROM data2 WHERE id=$id") or die($mysqli->error);
   if (count($result) == 1) {
      $row = $result->fetch_array();
      $name = $row['name'];
      $location = $row['location'];
   }
}

if (isset($_POST['update'])) {
   $id = $_POST['id'];
   $name = $_POST['name'];
   $location = $_POST['location'];

   $mysqli->query("UPDATE data2 SET name='$name', location='$location' WHERE id=$id") or die($mysqli->error);

   $_SESSION['message'] = "Информация о пользователе была обновлена";
   $_SESSION['msg_type'] = "warning";

   header('location: crud.php');
}
