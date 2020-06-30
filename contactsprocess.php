<?php

session_start();

$mysqli = new mysqli('std-mysql', 'std_972', 'dapa0803', 'std_972') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$name = '';
$location = '';
$telephone = '';

if (isset($_POST['save'])) {
   $name = $_POST['name'];
   $location = $_POST['location'];
   $telephone = $_POST['telephone'];

   $mysqli->query("INSERT INTO contact (name, location, telephone) VALUES('$name','$location','$telephone')") or die($mysqli->error);

   $_SESSION['message'] = "Пользователь был добавлен!";
   $_SESSION['msg_type'] = "success";

   header("location: contacts.php");
}


if (isset($_GET['delete'])) {
   $id = $_GET['delete'];
   $mysqli->query("DELETE FROM contact WHERE id=$id") or die($mysqli->error);

   $_SESSION['message'] = "Пользователь был удален!";
   $_SESSION['msg_type'] = "danger";

   header("location: contacts.php");
}

if (isset($_GET['edit'])) {
   $id = $_GET['edit'];
   $update = true;
   $result = $mysqli->query("SELECT * FROM contact WHERE id=$id") or die($mysqli->error);
   if (count($result) == 1) {
      $row = $result->fetch_array();
      $name = $row['name'];
      $location = $row['location'];
      $telephone = $row['telephone'];
   }
}

if (isset($_POST['update'])) {
   $id = $_POST['id'];
   $name = $_POST['name'];
   $location = $_POST['location'];
   $telephone = $_POST['telephone'];

   $mysqli->query("UPDATE contact SET name='$name', location='$location', telephone='$telephone'[ WHERE id=$id") or die($mysqli->error);

   $_SESSION['message'] = "Информация о пользователе была";
   $_SESSION['msg_type'] = "warning";

   header('location: contacts.php');
}
