<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bibliotheque | Accueil</title>
  <!-- Bootstrap -->
  <link href="style/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style/css/index.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <link href="style/css/style.css" rel="stylesheet">
  <!--<link rel="stylesheet" href="style/bootstrap.min.css">-->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- /**Le jquery ne se trouve pas dans le download boot strap on est obligé de le récupérer enligne!*/-->
<script src="js/bootstrap.min.js"></script>
  <style>


  </style>
</head>
<body>


<?php
session_start();
include("include/outils.php");
include("include/livre.php");
include("include/utilisateur.php");
if (isset($_POST['inscription'])) {
  header('Location: inscription.php');
  die() ;
}
echo menuConnexion();
echo Index();
//echo Carrousel();

 ?>
 <div id="article">
  <article id="article1">
    <h1>Présentation</h1>
    <div id="sommaire">
      <p>Présentation du projet</p><br /> <p>Présentation du contexte</p><br /><p>Présentation de la structure du site</p>
    </div>
  </article>
  <article id="article2">
    <h1> Dernieres sorties </h1>
    <div class="new"><div class="photo">photo</div><div class="resum"><p>Résumé, note</p></div></div>
    <div class="new"><div class="photo">photo</div><div class="resum"><p>Résumé, note</p></div></div>
    <div class="new"><div class="photo">photo</div><div class="resum"><p>Résumé, note</p></div></div>
    <div class="new"><div class="photo">photo</div><div class="resum"><p>Résumé, note</p></div></div>
  </article>
</div>
<?php
echo piedPage();
?>
