<?php

  function debug($variable){

      echo '<pre>' . print_r($variable, true) . '</pre>';

}

function str_random($length){
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
}

function logged_only(){

  if(session_status() == PHP_SESSION_NONE){

    session_start();
  }

  if(!isset($_SESSION['auth'])){

      $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'acceder à cette page ";


    header('Location: login.php');

    exit();

  }
}
function com_log(){

  if(session_status() == PHP_SESSION_ACTIVE){
  }

if (!isset($_SESSION['statut']) || $_SESSION['statut']!='admin') {


  $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'acceder à cette page ";


  header("location: account.php");
  exit;
 }
 session_write_close(); // fermeture de la session pour éviter les warning si  ré-ouverture dans une page.

}
