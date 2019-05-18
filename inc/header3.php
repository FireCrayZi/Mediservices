
<?php

      if (session_status() == PHP_SESSION_NONE){

        session_start();
      }
 ?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Médiservices</title>

    <!-- Bootstrap core CSS -->

    <link href="css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">


  </head>

  <body>

    <nav class="navbar navbar-inverse ">
      <div class="container">
        <div class="">

          <a class="navbar-brand" href="account.php">Médiservices  </a>
        </div>
        <div id="navbar" class="">
          <ul class="nav navbar-nav">

              <?php if(isset($_SESSION['auth'])): ?>


                  <li><a href="logout.php" >Se Déconnecter</a></li>

              <?php //else: ?>

            <li ><a href="register.php">S'inscrire</a></li>

          <?php endif; ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">


      <?php if(isset($_SESSION['flash'])): ?>


        <?php foreach($_SESSION['flash'] as $type => $message): ?>

          <div class="alert alert-<?= $type;?>">
            <?= $message; ?>
          </div>


      <?php endforeach; ?>

        <?php unset($_SESSION['flash']); ?>


    <?php endif; ?>
