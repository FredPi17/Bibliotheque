<?php
include("include/outils.php");
include("include/utilisateur.php");
include("include/livre.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	  <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <title>Liste des livres</title>
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
</head>
<title>Répertoire</title>
<meta charset="utf-8"/>
</head>
<body>
<?php
echo Menu();
try {
	echo '<h1>Listes des livres</h1>'."\n";/*le titre*/
	echo '<table>'."\n"; /*ouvre le tableau*/
	echo '<tr><th>Auteur</th><th>Titre</th><th>Image</th>' ."\n";/*nom des colonnes*/
	$reponse = $bdd->query('SELECT objet.IDobjet as IDobjet, auteur.Nom, objet.Titre, objet.image from objet, auteur where auteur.IDauteur = objet.IDauteur');
	// On affiche chaque entrée une à une

	while ($donnees = $reponse->fetch()) {
		echo  '<tr><td>'. $donnees['Nom'] . '</td><td><a href="fichelivre.php?IDobjet=' . $donnees['IDobjet'] . '">' . $donnees['Titre'] . '</a></td><td>' . $donnees['image'] . '</td></tr>' . "\n" ;
		echo '<form action="fichelivre.php" method="post">
			<input type="hidden" name="livre" value.= '. $donnees['Titre'];
	}
	$reponse->closeCursor(); // Termine le traitement de la requête
	echo '</table>';
} catch(Exception $e) {
	// En cas d'erreur précédemment, on affiche un message et on arrête tout
	die('Erreur : '.$e->getMessage());
}
?>
	</body>
</html>
