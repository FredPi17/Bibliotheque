<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inscription</title>
  <!-- Bootstrap -->
    <link href="style/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <link href="style/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="style/bootstrap.min.css">
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <!-- /**Le jquery ne se trouve pas dans le download boot strap on est obligé de le récupérer enligne!*/-->

</head>
<?php
include("include/outils.php");
include("include/livre.php");

if (isset($_POST['retour'])) {
  header('Location: index.php');
  die() ;
}

if(isset($_POST['inscription'])){
  echo controleFormInscription($_POST);
}

//echo controleFormInscription($tab);

//echo ajouteUtilisateur($tab);

echo afficheFormInscription();
?>
