<?php 

require 'inc/db.php';
require 'inc/functions.php';

 if (isset($_GET['id'])){

        $req = $pdo->prepare("DELETE FROM users WHERE id = ?");
             $req->execute([$_GET['id']]);
        header('Location: register.php');
 }


?>