<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bibliotheque | Accueil</title>
  <!-- Bootstrap -->
    <link href="style/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/css/foundation.css">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <link href="style/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="style/bootstrap.min.css">
  <link rel="stylesheet" href="style/css/ficheutilisateur.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <!-- /**Le jquery ne se trouve pas dans le download boot strap on est obligé de le récupérer enligne!*/-->
  <script src="js/bootstrap.min.js"></script>

</head>
<style>
  #part1, #part2{
    display: inline-block;
  }
  #fiche{
    border: 1px solid black;
  }
</style>
<?php
session_start();
include("include/outils.php");
include("include/utilisateur.php");
echo menuConnexion();
echo Menu();
if (isset($_GET['code'])) {
  echo ficheProfil();
    }

if(isset($_GET['retour'])){
  header('Location: listeutilisateur.php');
  die();
}

if (isset($_POST['supprimer'])){
  	supprimer();
}

if (isset($_POST['modifier'])){
  modifier();
}

if (estConnecte()){

  echo profil();
  echo livresReserves();
}
if (estAdmin()){

  echo listeUtilisateur();
  echo listeLivres();
  echo listeLivresReserves();

}

echo piedPage();

?>
