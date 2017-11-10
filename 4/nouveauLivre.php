<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bibliotheque | Accueil</title>
<link href="style/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style/css/index.css">
<link rel="stylesheet" href="style/css/foundation.css">

<link href="style/css/style.css" rel="stylesheet">
<!--<link rel="stylesheet" href="style/bootstrap.min.css">-->
<style>
  input{
    max-width: 500px;
  }
div{
  text-align: center;
}
  </style>
</head>
<?php

session_start();
include("include/outils.php");
include("include/utilisateur.php");
include("include/livre.php");
echo menuConnexion();
echo Menu();
if (estAdmin()) {
  $donnees['cat1'] = 0;
  $donnees['auteur1'] = 0; ?>
  <div class="ui main container">
  	<div class="row">
  		<div class="callout">
  			<div class="row">
  				<div class="large-12 columns" style="text-align:center;">
            <h1>Nouveau livre</h1>
          </div>
        </div>
        <div class="row">
          <div class="large-6 columns" style="">
            <form method="get" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
              <input type="text" name="isbn" id="isbn" placeholder="ISBN"/>
              <input type="text" name="titre" id="titre" placeholder="Titre"/>
              <input type="text" name="resume" id="resume" placeholder="Résumé"/>
              <label for="icone">Couverture du livre</label>
              <input type="file" name="icone" id="icone" placeholder="Couverture du livre"/>
            </div>
            <div class="large-6 columns">
              <?php echo listeAuteur($donnees['auteur1']); ?>
              <input type="text" name="auteur2" id="auteur2" placeholder="Autre auteur"/>
              <?php echo listeCat($donnees['cat1']); ?>
              <input type="text" name="cat2" id='cat2' placeholder="Autre catégorie"/>
          </div>
          <div class="large-12 columns">
            <input type="submit" name="envoyer" value="envoyer">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
}
if(!estAdmin()) {
  echo "<div>Vous n'êtes pas autorisé d'accéder à cette page </div>";
}

if (isset($_GET['envoyer'])){
  nouveauLivre();
}
echo piedPage();
?>
