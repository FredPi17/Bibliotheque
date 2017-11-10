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
  <link rel="stylesheet" href="style/css/foundation.css">
  <link href="style/css/style.css" rel="stylesheet">
  <!--<link rel="stylesheet" href="style/bootstrap.min.css">-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <style>
  .row.news{
    border: 1px grey solid;
    margin-top:4px;
  }
  .large-8.columns{
    border-left: 1px solid grey;
  }

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
 <div class="ui main container" id="menu">
   <div class="row">
     <div class="callout">
       <div class="row">
         <div class="large-12 columns">
           <div class="large-9 columns">
              <h1>Présentation</h1>
              <div id="sommaire">
                <p>Présentation du projet</p><br /> <p>Présentation du contexte</p><br /><p>Présentation de la structure du site</p>
              </div>
            </div>
            <div class="large-3 columns">
                <?php echo last();?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<?php
echo piedPage();
?>
