<?php
session_start();
require ('inc/functions.php');
logged_only();

        require_once 'inc/db.php';

require ('inc/header4.php');


if(!empty($_POST['newlending'])) {
if(empty($errors)){
                //Faire un pret
                // On enregistre les informations dans la base de données
                // $upd =  $pdo->exec("UPDATE materiel SET numserie = ?, statut = en pret");
                $req = $pdo->prepare("INSERT INTO pret SET idMateriel = ?, numserie = ?, ref = ?, datedebut = ?, datefin = ?, client = ?");
                $upd = $pdo->prepare("UPDATE materiel SET statut = 'en pret', numserie = ? WHERE ref = ?");
                $req->execute([$_POST['idMateriel'], $_POST['numserie'], $_POST['ref'], $_POST['datedebut'], $_POST['datefin'], $_POST['client']]);
                $upd->execute([ $_POST['numserie'], $_POST['ref']]);
        } 
}


if(!empty($_POST['changeitem'])) {
        if(empty($errors)){
                // On change la date de debut et de fin en fonction de l'id
               
                $req = $pdo->prepare("UPDATE pret SET datedebut = ?, datefin= ? WHERE id = ?");
                $req->execute([ $_POST['datedebut'], $_POST['datefin'],$_POST['id']]);
               
        }
        }

?>


<h3>Bonjour, <?= $_SESSION['auth']->username; ?></h3>

<div class="container">
  <div class="row">
                        <!-- Pret de materiel -->

                        <form action="" method="POST" class="col-md-4 ">
                        <div class="form-row ">
                        <div class="col">
                                <fieldset class="fieldset">
                                        <!-- <legend>Prêt</legend> -->
  
                                <label for="">Prêter un Matériel</label><br />
                                        <select name="idMateriel">
                                                <option value=""></option>
                                                <option value = "defibrilateur"  name="idMateriel" onclick="disabled">Défibrilateur</option>
                                                <option value = "Lit"  name="idMateriel">Lit médicalisé</option>
                                                <option value = "fauteuils"  name="idMateriel">Fauteuil roulant</option>
                                        </select><br/>
                                <label for="">Numéro de série:</label><br/>
                                                <input type="text" name="numserie" ><br/>
                                <label for="">Référence:</label><br/>
                                                <input type="text"  name="ref"><br/>
                                <label for="">Début du prêt:</label><br/>
                                                <input type="date" name='datedebut'/><br/>
                                <label for="">Retour prévu:</label><br/>
                                                <input type="date" name='datefin'/><br/>
                                <label for="">Client:</label><br/>
                                                <input type="text" name="client"><br/><br/>

                                                <input type="submit" value='Envoyer' name='newlending'>
                                        
                                 </fieldset>
                                 </div>
                                 </div>
                        </form>
                        <form action="" method="POST" class="col-md-4 ">
                        <div class="form-group ">
                                <fieldset class="fieldset">
                                        <!-- <legend>Prêt</legend> -->
  
                                <label for="">Changer les dates de prêt</label><br />
                                <label for="">Id pret</label><br/>
                                <input type="text" name="id"><br/> 
                                                <label for="">Début du prêt:</label><br/>
                                                <input type="date" name='datedebut'/><br/>
                                <label for="">Retour prévu:</label><br/>
                                                <input type="date" name='datefin'/><br/>
                                                <input type="submit" value='Envoyer' name="changeitem">
                                 </fieldset>
                        </form>
                        </div>
                    
                     
                       

<?php
require 'inc/db.php';
$req = $pdo->query('SELECT * FROM pret ');
$couleur = $pdo->query('SELECT statut FROM materiel');


?>

  
  <table class="table table-striped pret" style="background-color: #BFBFBF; color: #494848;">



  <thead>
      <tr >
          <th>Id</th>
          <th>Materiel</th>
          <th>Numéro de série</th>
          <th>Réference</th>
          <th>Date de début</th>
          <th>Date de fin</th>
          <th>Client</th>
          
      </tr>
      </thead>

      <tbody>
        

<?php while ($mat = $req->fetch()): ?>
<tr><td><?= $mat->id ?></td><td>
<?= $mat->idMateriel ?></td><td>
<?= $mat->numserie ?></td><td>
<?= $mat->ref ?></td><td>
<?= $mat->datedebut ?></td><td>
<?= $mat->datefin ?></td><td>
<?= $mat->client ?></td><td>
<a href="supprimer.php?id=<?= $mat->id ?>"><i class="fas fa-trash-alt"></i></a></td></tr>
<?php endwhile; ?>
                        

<?php require ('inc/footer.php'); ?>
