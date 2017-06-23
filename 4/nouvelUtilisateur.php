<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bibliotheque | Accueil</title>
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

  </style>
</head>
<?php
session_start();
include("include/outils.php");
include("include/utilisateur.php");
echo menuConnexion();
echo Menu();
?>
<h1>Nouvel utilisateur</h1>
<?php

  echo afficheFormNouveau();

if (isset($_POST['nouveau'])){
  $NewPassword = sha1($_POST['mdp'] . DB_SALT . strtolower($_POST['mail']));
  $p_requete = $bdd->prepare('INSERT INTO utilisateur (MDP, Mail, Nom, Prenom, Admin) VALUES (:mdp, :mail, :nom, :prenom, :admin)');
  $p_requete->execute(array(
    'mdp' => $NewPassword,
    'mail' => $_POST['mail'],
    'nom' => $_POST['nom'],
    'prenom' => $_POST['prenom'],
    'admin' => $_POST['admin']
  ));
  header('Location: ficheutilisateur.php?code='.$_POST['code']);
  die();
}

if(isset($_POST['retour'])){
  header('Location: ficheutilisateur.php'.$_POST['code']);
  die();
}
?>
