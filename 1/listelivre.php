<?php
require_once("include/outils.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<title>Répertoire</title>
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
