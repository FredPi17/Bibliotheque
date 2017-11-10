<?php
include("connexion.php");
function listelivre(){
try {
	echo '<h1>Listes des livres</h1>'."\n";/*le titre*/
	echo '<table>'."\n"; /*ouvre le tableau*/
	echo '<tr><th>Auteur</th><th>Titre</th><th>Image</th>' ."\n";/*nom des colonnes*/
	$reponse = $bdd->query('SELECT auteur.Nom, objet.Titre, objet.image from objet, auteur where auteur.IDauteur = objet.IDauteur');
	// On affiche chaque entrée une à une

	while ($donnees = $reponse->fetch()) {
		echo  '<tr><td>'. $donnees['Nom'] . '</td><td>' . $donnees['Titre'] . '</td><td>' . $donnees['image'] . '</td></tr>' . "\n" ;
	}
	$reponse->closeCursor(); // Termine le traitement de la requête
	echo '</table>';
} catch(Exception $e) {
	// En cas d'erreur précédemment, on affiche un message et on arrête tout
	die('Erreur : '.$e->getMessage());
}
}
?>