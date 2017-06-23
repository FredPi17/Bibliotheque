<?php
include("include/outils.php");
include("include/utilisateur.php");
include("include/livre.php");

if (isset($_POST['retour'])) {
  header('Location: index.php');
  die() ;
}
/*if (isset($_POST['connecter'])) {
  global $p_base;
  $p_requeteConnexion = $p_base->prepare('SELECT IDutilisateur, MDP, Mail, Nom, Prenom, Admin
                                          FROM utilisateur
                                          WHERE lower(login) = :login');
  $p_requeteConnexion->execute(array(
    'mail' => $_POST['login']));

  if ($id = $p_requeteConnexion->fetch())
  {
    if ($id['MDP'] == sha1($_POST['mdp'] . DB_SALT . strtolower($_POST['login']))) {
      $_SESSION['code'] = $id['IDutilisateur'];
			$_SESSION['login'] = $id['login'];
			$_SESSION['droits'] = $id['droits'];
      header('Location: index.php');
      die() ;
    }
  }
  else {
    echo "<br>Erreur test";
  }
}*/
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="initial-scale=1, user-scalabe=yes"/>
  <meta charset="utf-8" />
  <title>Connexion</title>
  <meta name="generator" content="Bootply" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link href="style/css/bootstrap.min.css" rel="stylesheet">
  <link href="style/css/styles.css" rel="stylesheet">
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
  <!--[if lt IE 9]>
  <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <link href="css/styles.css" rel="stylesheet">

</head>
<body>
  <?php echo menuConnexion(); ?>
</body>
</html>
