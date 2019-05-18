<?php



  if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){


      require_once 'inc/db.php';
      require_once 'inc/functions.php';



      $req = $pdo->prepare('SELECT * FROM users WHERE (username = :username OR) AND confirmed_at IS NOT NULL');

      $req->execute(['username' => $_POST['username']]);

      $user = $req->fetch();

      if(password_verify($_POST['password'], $user->password)){

        session_start();

        $_SESSION['auth'] = $user;

        $_SESSION['flash']['success'] = 'Vous êtes maintenant bien connecté au site';

        header('Location: account.php');

        exit();
  } else{

      $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrecte';

  }

}

  ?>

<?php

if(isset($_GET['id']) && isset($_GET['token'])){
    require 'inc/db.php';
    require 'inc/functions.php';
    $req = $pdo->prepare('SELECT * FROM users WHERE id = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)');
    $req->execute([$_GET['id'], $_GET['token']]);
    $user = $req->fetch();
    if($user){
        if(!empty($_POST)){
            if(!empty($_POST['password']) && $_POST['password'] == $_POST['password_confirm']){
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $pdo->prepare('UPDATE users SET password = ?, reset_at = NULL')->execute([$password]);
                session_start();
                $_SESSION['flash']['success'] = 'Votre mot de passe a bien été modifié';
                $_SESSION['auth'] = $user;
                header('Location: account.php');
                exit();
            }
        }
    }else{
        session_start();
        $_SESSION['flash']['error'] = "Ce token n'est pas valide";
        header('Location: login.php');
        exit();
    }
}else{
    header('Location: login.php');
    exit();
}


?>

<?php require ('inc/header.php'); ?>


<h1>Réinitialiser mon mot de passe</h1>



<form action="" method="POST">


    <div class="form-group">

      <label for"">Mot de passe </label>

      <input type="Password" name="password"class="form-control" />

    </div>


    <div class="form-group">

      <label for"">Confirmation du Mot de passe</label>

      <input type="Password" name="password_confirm"class="form-control" />

    </div>

    <button type="submit" class="btn btn-primary">Réinitialiser mon mot de passe</button>
  </form>


<?php require ('inc/footer.php'); ?>
