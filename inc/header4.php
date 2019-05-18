<?php

      if (session_status() == PHP_SESSION_NONE){

        session_start();
      }
 ?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Médiservices</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark " style="background-color :#24B31A">
      <div class='container-fluid'>
  <a class="navbar-brand" href="account.php">Médiservices</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">


                <?php if(isset($_SESSION['auth'])): ?>
                

      <a class="nav-item nav-link" href="logout.php">Se déconnecter <span class="sr-only">(current)</span></a>
      
      <a class="nav-item nav-link" href="register.php">S'inscrire</a>
      <a class="nav-item nav-link" href="gestion_pret.php">Gestion des matériels</a>
      
      <?php else: ?>

      
             
             
             <?php endif; ?>
             
           
      
    </div>
  </div>
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

