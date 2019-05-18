
<?php
 require_once 'inc/functions.php';

 session_start();
logged_only();
com_log();
if(!empty($_POST)) {

    $errors = array();

    require_once 'inc/db.php';
 

if(empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])){


    $errors['username'] = "Votre pseudo n'est pas valide (alphanumérique)";

  } else {
    $req = $pdo->prepare('SELECT id FROM users WHERE username = ?');

    $req->execute([$_POST['username']]);

    $user = $req->fetch();

      if ($user) {
        $errors['username'] = 'Ce pseudo est déjà pris';
      }
  }


if(empty($errors)){

    // On enregistre les informations dans la base de données
    $req = $pdo->prepare("INSERT INTO users SET username = ?, password = ?, Nom = ?, statut = ?");
    // On ne sauvegardera pas le mot de passe en clair dans la base mais plutôt un hash
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    // On génère le token qui servira à la validation du compte
    $token = str_random(60);
    $req->execute([$_POST['username'], $password, $_POST['Nom'], $_POST['perm']]);
    $user_id = $pdo->lastInsertId();
    // On envoit l'email de confirmation

     header('Location: register.php');
    exit();

}





}
?>
<?php require 'inc/header4.php'; ?>

<h1>S'inscrire</h1>

<?php if(!empty($errors)): ?>

  <div class="alert alert-danger">
    <p>Vous n'avez pas remplis le formulaire correctement</p>
<ul>
    <?php foreach ($errors as $error): ?>

      <li><?= $error; ?> </li>
    <?php endforeach; ?>
  </ul>

  </div>


<?php endif; ?>
<div class="container">
  <div class="row">


<form action="" method="POST" class="col-md-4">
    <div class="form-group">

      <label for"">Prénom</label>

      <input type="text" name="username" class="form-control" />

    </div>
    <div class="form-group">

      <label for"">Nom</label>

      <input type="text" name="Nom" class="form-control" />

    </div>



    <div class="form-group">

      <label for"">Mot de passe</label>

      <input type="Password" name="password"class="form-control" />

    </div>

    <div class="form-group">
      Statut<br />
      <input type="radio" name="perm" value="admin" /> <label for="">Administrateur</label>
      <input type="radio" name="perm" value="Commercial"/> <label for="">Commercial</label><br />

    </div>


    <button type="submit" class="btn btn-primary">M'inscrire</button>
    
  </form>
<?php
require 'inc/db.php';
$req = $pdo->query('SELECT * FROM users');

?>

  <div class="col-md-6 col-md-offset-2 ">
  <table class="table table-striped " style="background-color: grey; color: #494848;">



  <thead>
      <tr >
          <th>Id</th>
          <th>Prenom</th>
          <th>Nom</th>
          <th>Statut</th>
          
      </tr>
      </thead>

      <tbody>
        

<?php while ($membres = $req->fetch()): ?>
<tr><td><?= $membres->id ?></td><td>
<?= $membres->username ?></td><td>
<?= $membres->Nom ?></td><td>
<?= $membres->statut ?></td><td>
<a href="supprimer.php?id=<?= $membres->id ?>"><i class="fas fa-trash-alt"></i></a></td></tr>
<?php endwhile; ?>
       
        
      </tbody>
      </div>

  </table>
  </div>
  </div>


<?php require 'inc/footer.php'; ?>
