<?php
include("include/outils.php");
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
	echo '<h1>Listes des Utilisateurs</h1>'."\n";/*le titre*/
	echo '<table>'."\n"; /*ouvre le tableau*/
	echo '<tr><th>Nom</th><th>Prénom</th>' ."\n";/*nom des colonnes*/
	$reponse = $bdd->query('SELECT utilisateur.IDutilisateur as IDutilisateur, utilisateur.nom as Nom, utilisateur.prenom as Prenom from utilisateur');
	// On affiche chaque entrée une à une

	while ($donnees = $reponse->fetch()) {
		echo  '<tr><td>'. $donnees['Nom'] . '</td><td><a href="ficheutilisateur.php?IDutilisateur=' . $donnees['IDutilisateur'] . '">' . $donnees['Prenom'] . '</a></td></tr>' . "\n" ;
		echo '<form action="ficheutilisateur.php" method="post">
			<input type="hidden" name="Nom" value.= '. $donnees['Nom'];
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
