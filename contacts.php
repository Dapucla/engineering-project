<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Yellowtail&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap-grid.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
   <link rel="stylesheet" type="text/css" href="css/user.css">
</head>

<body>

   <nav class="navbar navbar-expand-md bg-info navbar-dark">
      <!-- Brand -->
      <a class="navbar-brand" href="index.html">Hedo Cakes</a>

      <!-- Toggler/collapsibe Button -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
         <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar links -->
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
         <ul class="navbar-nav">
            <li class="nav-item">
               <a class="nav-link" href="aboutus.html">О нас</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="order.php">Заказать</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="contacts.php">Контакты</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="crud.php">Пользователи</a>
            </li>
         </ul>
      </div>
   </nav>
   <?php require_once 'contactsprocess.php'; ?>
   <div class=" row justify-content-center">
      <h1>Свяжемся с вами </h1>
   </div>

   <div class=" row justify-content-center">
      <form action="contactsprocess.php" method="POST">
         <input type="hidden" name="id" value="<?php echo $id; ?>">
         <div class="form-group">
            <label>Имя</label>
            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Введите ваше имя">
         </div>
         <div class="form-group">
            <label>Почта</label>
            <input type="text" name="location" class="form-control" value="<?php echo $location; ?>" placeholder="Введите вашу почту">
         </div>
         <div class="form-group">
            <label>Телефон</label>
            <input type="text" name="telephone" class="form-control" value="<?php echo $telephone; ?>" placeholder="Введите ваш телефон">
         </div>
         <div class="form-group">
            <?php
            if ($update == true) :
            ?>
               <button class="btn btn-info" type="submit" name="update">Обновить</button>
            <?php else : ?>
               <button class="btn btn-primary" type="submit" name="save">Сохранить</button>
            <?php endif; ?>
         </div>
      </form>
   </div>

   <?php
   if (isset($_SESSION['message'])) :
   ?>

      <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
         <?php
         echo $_SESSION['message'];
         unset($_SESSION['message']);
         ?>
      </div>
   <?php endif ?>

   <div class="container">
      <?php
      $mysqli = new mysqli('std-mysql', 'std_972', 'dapa0803', 'std_972') or die(mysqli_error($mysqli));
      $result = $mysqli->query("SELECT * FROM contact") or die($mysqli->error);
      ?>

      <div class="row justify-content-center">
         <table class="table">
            <thead>
               <tr>
                  <th>Имя</th>
                  <th>Почта</th>
                  <th>Телефон</th>
                  <th colspan="2">Действие</th>
               </tr>
            </thead>
            <?php
            while ($row = $result->fetch_assoc()) : ?>
               <tr>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['location']; ?></td>
                  <td><?php echo $row['telephone']; ?></td>
                  <td>
                     <a href="contacts.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Редактировать</a>
                     <a href="contactsprocess.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Удалить</a>
                  </td>
               </tr>
            <?php endwhile; ?>
         </table>
      </div>


      <?php
      function pre_r($array)
      {
         echo '
   <pre>';
         print_r($array);
         echo '<pre>';
      }

      ?>


   </div>
</body>

</html>