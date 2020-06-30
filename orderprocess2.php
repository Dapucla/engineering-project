<?php

session_start();

$mysqli = new mysqli('std-mysql', 'std_972', 'dapa0803', 'std_972') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$name = '';
$mail = '';

if (isset($_POST['save'])) {
   $name = $_POST['name'];
   $mail = $_POST['mail'];

   $mysqli->query("INSERT INTO ordercontact (name, mail) VALUES('$name','$mail')") or die($mysqli->error);

   $_SESSION['message'] = "Десерт был добавлен в заказ";
   $_SESSION['msg_type'] = "success";

   header("location: order.php");
}


if (isset($_GET['delete'])) {
   $id = $_GET['delete'];
   $mysqli->query("DELETE FROM ordercontact WHERE id=$id") or die($mysqli->error);

   $_SESSION['message'] = "Заказ был удален!";
   $_SESSION['msg_type'] = "danger";

   header("location: order.php");
}

if (isset($_GET['edit'])) {
   $id = $_GET['edit'];
   $update = true;
   $result = $mysqli->query("SELECT * FROM ordercontact WHERE id=$id") or die($mysqli->error);
   if (count($result) == 1) {
      $row = $result->fetch_array();
      $name = $row['name'];
   }
}

if (isset($_POST['update'])) {
   $id = $_POST['id'];
   $name = $_POST['name'];
   $mail = $_POST['mail'];


   $mysqli->query("UPDATE ordercontact SET name='$name', mail='$mail' WHERE id=$id") or die($mysqli->error);

   $_SESSION['message'] = "Информация о заказе была обновлена";
   $_SESSION['msg_type'] = "warning";

   header('location: order.php');
}
