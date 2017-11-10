<?php
include("include/outils.php");
include("include/utilisateur.php");
include("include/livre.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<title>Répertoire</title>
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
<meta charset="utf-8"/>
</head>
<body>
<header>
	<nav>
	<ul>
	</ul>
	</nav>
</header>

<?php
echo Menu();
try {
	echo '<h1>Listes des Utilisateurs</h1>'."\n";/*le titre*/
	echo '<table>'."\n"; /*ouvre le tableau*/
	echo '<tr><th>Nom</th><th>Prénom</th>' ."\n";/*nom des colonnes*/
	$reponse = $bdd->query('SELECT utilisateur.IDutilisateur as IDutilisateur, utilisateur.nom as Nom, utilisateur.prenom as Prenom from utilisateur');
	// On affiche chaque entrée une à une

	while ($donnees = $reponse->fetch()) {
		echo  '<tr><td>'. $donnees['Nom'] . '</td><td><a href="ficheutilisateur1.php?IDutilisateur=' . $donnees['IDutilisateur'] . '">' . $donnees['Prenom'] . '</a></td></tr>' . "\n" ;
		echo '<form action="ficheutilisateur1.php" method="post">
			<input type="hidden" name="Nom" value.= '. $donnees['Nom'];
	}
	$reponse->closeCursor(); // Termine le traitement de la requête
	echo "</tr>\n";
		echo '<tr>';
		echo '<form method="post" action"ficheutilisateur1.php">';
		echo '<td><input type="submit" name="nouveau" value="Nouveau"</td>';
		echo '</form>';
	echo '</table>';
} catch(Exception $e) {
	// En cas d'erreur précédemment, on affiche un message et on arrête tout
	die('Erreur : '.$e->getMessage());
}
?>
	</body>
</html>
