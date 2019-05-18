<?php
 require_once 'inc/functions.php';

 session_start();
logged_only();
com_log();

    require_once 'inc/db.php';

    require ('inc/header4.php');
if(!empty($_POST)) {

    $errors = array();



    if(!empty($_POST['newitem'])) {
        if(empty($errors)){
                // Rajouter un materiel dans la base de données
                // On enregistre les informations dans la base de données
                $req = $pdo->prepare("INSERT INTO materiel SET ref = ?, Materiel = ?");
                $req->execute([$_POST['ref'], $_POST['Materiel']]);
                
        }
        }
        
        if(!empty($_POST['changeitem'])) {
                if(empty($errors)){
                        // On change la date de debut et de fin en fonction de l'id
                       
                        $req = $pdo->prepare("UPDATE pret SET datedebut = ?, datefin= ? WHERE id = ?");
                        $req->execute([ $_POST['datedebut'], $_POST['datefin'],$_POST['id']]);
                       
                }
                }
            }
         ?>
        




                        <!-- Rajouter un materiel dans la base -->
                        
                        <form action="" method="POST" class="col-md-6 gestpret">
                        <div class="form-group ">
                                <fieldset class="fieldset">
                                        <!-- <legend>Prêt</legend> -->
  
                                <label for="">Rajouter du matériel</label><br />
                                        <select name="Materiel" id = "Materiel">
                                                <!-- <option value = "" ></option> -->
                                                <option value = "defibrilateur" name="materiel">Défibrilateur</option>
                                                <option value = "Lit" name="materiel">Lit médicalisé</option>
                                                <option value = "fauteuils" name="materiel">Fauteuil roulant</option>
                                        </select><br/>
                                <label for="">Référence:</label><br/>
                                <input type="text" name="ref"><br/>        
                                                <input type="submit" value='Envoyer' name="newitem">
                                        
                                 </fieldset>
                                 </div>
                        </div>
                        </form>
                        </div>
                        
                        <?php
require 'inc/db.php';
$req = $pdo->query('SELECT * FROM materiel');

?>

  
  <table class="table table-striped pret" style="background-color: #BFBFBF; color: #494848;">



  <thead>
      <tr >
          <th>Id</th>
          <th>Materiel</th>
          <th>Réference</th>
          <th>Numéro de série</th>
          <th>Statut</th>


      </tr>
      </thead>

      <tbody>
        

<?php while ($materiel = $req->fetch()): ?>
<tr><td><?= $materiel->id ?></td><td>
<?= $materiel->materiel ?></td><td>
<?= $materiel->ref ?></td><td>
<?= $materiel->numserie ?></td><td>
<?= $materiel->statut ?></td><td>
<a href="supprimer.php?id=<?= $materiel->id ?>"><i class="fas fa-trash-alt"></i></a></td></tr>
<?php endwhile; ?>