
<?php
/** \fait par Hugo, Frederic, Loris*/
/*date14/12/2016*/
/* permet d'afficher la fiche détail de chaque livre*/
/*il faut encore réaliser un foreach pour afficher tous les commentaires et toutes les notes, pas seulement une de chaque*/

require_once("include/outils.php"); /*appel la fonction pour se connecter*/
include("include/utilisateur.php");
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<title>Répertoire</title>
<link href="style/css/style.css" rel="stylesheet">
<link href="style/css/bootstrap.min.css" rel="stylesheet">

<meta charset="utf-8"/>
</head>
<body>


<?php
	echo menuConnexion();
	echo Menu();
echo '<li><a href="listelivre.php">Retour liste des livres</a></li>';
	if(isset($_GET['IDobjet']))

		{
			global $bdd;
			$p_requete = $bdd->prepare('SELECT ISBN, Resume from objet where objet.IDobjet =:ID');

			$p_requete->execute(array('ID' => $_GET['IDobjet']));

			$p_requete2 = $bdd->prepare('SELECT Commentaire, etoiles from note where note.IDobjet =:ID');

			$p_requete2->execute(array('ID' => $_GET['IDobjet']));

			if($code_ISBN = $p_requete->fetch()){
				echo "L'ISBN est : " . $code_ISBN['ISBN'] . '<br>';
				echo "Résumé : " . $code_ISBN['Resume'] . '<br>';
			}
				if ($code_ISBN_Commentaire = $p_requete2->fetch()){
					echo "Commentaire : " . $code_ISBN_Commentaire['Commentaire'] . '<br>';
					echo "Note : " . $code_ISBN_Commentaire['etoiles'];
			}
				else {
					echo "Il n'y a pas encore de commentaire sur ce livre." . '<br>';
					echo "Il n'y a pas de note sur ce livre.";
				}
				if (estAdmin()){
					echo '<form method="get"><input type="submit" name="supprimer" value="Supprimer">';
					echo '<input type="hidden" name="IDobjet" value="' . $_GET["IDobjet"].'"></form>';
				}
			}
		/*	else
			{
			echo 'Ne jouer pas avec les url';
		}*/
	if (estAdmin()){
		if (isset($_GET['nouveau'])){
			  echo '<title>Nouveau livre</title>
			    <h1>Nouveau livre</h1><br>';
			$donnees['titre'] = '';
			$donnees['ISBN'] = '';
			$donnees['pays'] = '';
			$donnees['resume'] = '';
			$donnees['categorie'] = '';
			$donnees['langue'] = '';
			$donnees['editeur'] = '';
			$donnees['date-edition'] = '';

			echo '<form method="get">';
			echo '<table>';
			echo '<tr>';
			echo '<td><label for="nom">Titre :</label></td>';
			echo '<td><input type="text" name="titre" id="nom" value="' . $donnees['titre'] .'" required /></td>';
			echo "</tr>\n";

			echo '<tr>';
			echo '<td><label for="nom">ISBN :</label></td>';
			echo '<td><input type="text" name="ISBN" id="codepostal" value="' . $donnees['ISBN'] .'" required /></td>';
			echo "</tr>\n";

			echo '<tr>';
			echo '<td><label for="nom">Catégorie	 :</label></td>';
			echo '<td><input type="text" name="categorie" id="categorie" value="' . $donnees['categorie'] .'" required /></td>';
			echo "</tr>\n";

			echo '<tr>';
			echo '<td><label for="nom">Auteur	 :</label></td>';
			echo '<td><input type="text" name="pays" id="pays" value="' . $donnees['pays'] .'"></td>';
			echo "</tr>\n";

			echo '<tr>';
			echo '<td><label for="nom">Langue	 :</label></td>';
			echo '<td><input type="text" name="langue" id="langue" value="' . $donnees['langue'] .'"></td>';
			echo "</tr>\n";

			echo '<tr>';
			echo '<td><label for="nom">Résumé	 :</label></td>';
			echo '<td><input type="text" name="resume" id="resume" value="' . $donnees['resume'] .'"></td>';
			echo "</tr>\n";

			echo '<tr>';
			echo '<td><label for="nom">Editeur	 :</label></td>';
			echo '<td><input type="text" name="editeur" id="editeur" value="' . $donnees['editeur'] .'"></td>';
			echo "</tr>\n";

			echo '<tr>';
			echo '<td><label for="nom">Date édition	 :</label></td>';
			echo '<td><input type="text" name="date-edition" id="date-edition" value="' . $donnees['date-edition'] .'"></td>';
			echo "</tr>\n";

		  echo '<tr>';
		  echo '<td></td>';
		  echo '<td><input type="submit" name="annuler" value="annuler">';
		  echo '<input type="submit" name="valider" value="valider"></td>';
		  echo '</tr>';

		  echo '</table>';
		  echo '</form>';
		}
}
if(isset($_GET['annuler'])){
  header('Location: listelivre.php');
  die();
}

if (isset($_GET['supprimer'])){
	$p_requete2 = $bdd->prepare('DELETE from appartient where appartient.IDobjet = :objet');
	$p_requete2 -> execute(array('objet' => $_GET['IDobjet']));

	$p_requete3 = $bdd->prepare('DELETE from note where note.IDobjet = :objet');
	$p_requete3 -> execute(array('objet' => $_GET['IDobjet']));

	$p_requete4 = $bdd->prepare('DELETE from reservation where reservation.IDobjet = :objet');
	$p_requete4 -> execute(array('objet' => $_GET['IDobjet']));

  $p_requete = $bdd->prepare('DELETE from objet where objet.IDobjet = :objet');
  $p_requete -> execute(array('objet' => $_GET['IDobjet']));

  header('Location: listelivre.php?msg=Suppression bien effectuée !');
  die();
}
?>
</body>
</html>
