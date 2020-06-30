<?php



$mysqli = new mysqli('std-mysql', 'std_972', 'dapa0803', 'std_972') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$address = '';
$delivery = '';
$summ = 0;

if (isset($_POST['save'])) {
   $address = $_POST['address'];
   $delivery = $_POST['delivery'];

   $mysqli->query("INSERT INTO shipment (address, delivery) VALUES('$address','$delivery')") or die($mysqli->error);



   header("location: order.php");
}


if (isset($_GET['delete'])) {
   $id = $_GET['delete'];
   $mysqli->query("DELETE FROM shipment WHERE id=$id") or die($mysqli->error);



   header("location: order.php");
}

if (isset($_GET['edit'])) {
   $id = $_GET['edit'];
   $update = true;
   $result = $mysqli->query("SELECT * FROM shipment WHERE id=$id") or die($mysqli->error);
   if (count($result) == 1) {
      $row = $result->fetch_array();
      $name = $row['name'];
   }
}

if (isset($_POST['update'])) {
   $id = $_POST['id'];
   $address = $_POST['address'];
   $delivery = $_POST['delivery'];

   $mysqli->query("UPDATE shipment SET address='$address', delivery='$delivery' WHERE id=$id") or die($mysqli->error);



   header('location: order.php');
}
