<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fiche utilisateur</title>
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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <!-- /**Le jquery ne se trouve pas dans le download boot strap on est obligé de le récupérer enligne!*/-->
  <script src="js/bootstrap.min.js"></script>
  <style>

  </style>
</head>
<?php
/** \fait par Hugo, Frederic, Loris*/
/*date14/12/2016*/
/* permet d'afficher la fiche détail de chaque livre*/
/*il faut encore réaliser un foreach pour afficher tous les commentaires et toutes les notes, pas seulement une de chaque*/

include("include/outils.php"); /*appel la fonction pour se connecter*/
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<title>Fiche utilisateur</title>
<meta charset="utf-8"/>
</head>
<body>
<header>
	<nav>
	<ul>
		<li><a href="listeutilisateur.php">Retour liste utilisaterus</a></li>
	</ul>
	</nav>
</header>

<?php
	if(isset($_GET['IDutilisateur']))
		{
			global $bdd;
			$p_requete = $bdd->prepare('SELECT Nom, Prenom, Mail from utilisateur where utilisateur.IDutilisateur =:ID');

			$p_requete->execute(array('ID' => $_GET['IDutilisateur']));

			if($code_utilisateur = $p_requete->fetch()){
				echo "Le nom est : " . $code_utilisateur['Nom'] . '<br>';
				echo "Le prenom est : " . $code_utilisateur['Prenom'] . '<br>';
				echo "Le mail est : " . $code_utilisateur['Mail'] . '<br>';
			}
			else
			{
			echo 'Ne jouer pas avec les url';
			}
		}
?>
</body>
</html>
