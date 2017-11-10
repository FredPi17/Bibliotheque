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

$id = $_GET['id'];
if (isset($_POST['nouveau'])){
  $NewPassword = sha1($_POST['mdp'] . DB_SALT . strtolower($_POST['mail']));
  $last=$bdd->query('SELECT IDutilisateur from utilisateur ORDER BY IDutilisateur DESC LIMIT 1');
  while ($donnees = $last->fetch()){
    $idUtilisateur = $donnees['IDutilisateur'];
  }
  if ($idUtilisateur == NULL){
    $idUtilisateur = 1;
  }
  else{
    $idUtilisateur += 1;
  }
  $p_requete = $bdd->prepare("INSERT INTO utilisateur (IDutilisateur, MDP, Mail, Nom, Prenom, Admin, image) VALUES (:IDutilisateur, :mdp, :mail, :nom, :prenom, :admin, 'image/default.png')");
  $p_requete->execute(array(
    'IDutilisateur' => $idUtilisateur,
    'mdp' => $NewPassword,
    'mail' => $_POST['mail'],
    'nom' => $_POST['nom'],
    'prenom' => $_POST['prenom'],
    'admin' => $_POST['admin']
  ));
  header("Location: ficheutilisateur.php?id=$id");
  die();
}

/*
if(isset($_POST['retour'])){
  header("Location: ficheutilisateur.php?id=$id");
  die();
}*/
?>
