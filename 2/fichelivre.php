
<?php
/** \fait par Hugo, Frederic, Loris*/
/*date14/12/2016*/
/* permet d'afficher la fiche détail de chaque livre*/
/*il faut encore réaliser un foreach pour afficher tous les commentaires et toutes les notes, pas seulement une de chaque*/

require_once("include/outils.php"); /*appel la fonction pour se connecter*/
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
		<li><a href="listelivre.php">Retour liste des livres</a></li>
	</ul>
	</nav>
</header>

<?php
	if(isset($_GET['IDobjet']))

		{
			global $bdd; 
			$p_requete = $bdd->prepare('SELECT ISBN, Resume from objet where objet.IDobjet =:ID'); 

			$p_requete->execute(array('ID' => $_GET['IDobjet']));

			$p_requete2 = $bdd->prepare('SELECT Commentaire, etoiles from note where note.IDobjet =:ID');

			$p_requete2->execute(array('ID' => $_GET['IDobjet']));

			if($code_ISBN = $p_requete->fetch()){
				echo "L'ISBN est : " . $code_ISBN['ISBN'] . '<br>';
				echo "Resume : " . $code_ISBN['Resume'] . '<br>';
			}
				if ($code_ISBN_Commentaire = $p_requete2->fetch()){
					echo "Commentaire : " . $code_ISBN_Commentaire['Commentaire'] . '<br>';
					echo "Note : " . $code_ISBN_Commentaire['etoiles']; 
			}
				else { 
					echo "Il n'y a pas encore de note et de commentaires sur ce livre." . '<br>';
					echo "Il n'y a pas de note sur ce livre."; 
				}
			}
			else 
			{
			echo 'Ne jouer pas avec les url'; 
			}
		
?>
</body>
</html>