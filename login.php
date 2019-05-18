<?php
session_start();

        require_once 'inc/db.php';


    if(!empty($_POST)){ //&& !empty($_POST['username'])){ //&& !empty($_POST['password'])){
      require_once 'inc/db.php';
      require_once 'inc/functions.php';
      $req = $pdo->prepare('SELECT * FROM users WHERE (username = :username)');
      $req->execute(['username' => $_POST['username']]);
      $user = $req->fetch();
      if($user == null){
          $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrecte';
      }elseif(password_verify($_POST['password'], $user->password)){
          $_SESSION['auth'] = $user;
          $_SESSION['statut']= $user->statut;
          $_SESSION['flash']['success'] = 'Vous êtes maintenant connecté';
          header('Location: account.php');
          exit();
      }else{
          $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrecte';
      }

  }



  ?>



<?php require ('inc/header4.php'); ?>

<fieldset class="col-lg-6 col-lg-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 ">
<h1>Se connecter</h1>

<div class="container-fluid">

</div>

<form action="" method="POST" >
    <div class="form-group">


      <label for"">Pseudo</label>

      <input type="text" name="username" class="form-control " />

    </div>

    <div class="form-group ">

      <label for"">Mot de passe </label>

      <input type="Password" name="password"class="form-control " />

    </div>



    <button type="submit" class="btn btn-success">Se connecter</button>
  </form>
</fieldset>

<?php require ('inc/footer.php'); ?>
