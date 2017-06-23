
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
<style>
table{
	border: 1px solid black;
}
.livre{
	width: 400px;
	height: 250px;
	border: 1px solid black;
	padding-left: 50px;
	margin-top: 500px;
}
#image, #info{
	display: inline-block;
	margin: 5px;
	padding: 10px;
	vertical-align: middle;
}
article{
	border: 1px solid rgb(246,246,246);
	background-color: rgb(246,246,246);
}
#annexe{
	border: 1px solid black;
	width: 100%;
	height: auto;
	padding: 5px;
}
</style>

<?php
	echo menuConnexion();
	echo Menu();
echo '<a href="listelivre.php">&#8592; Retour liste des livres</a><br>';
	if(isset($_GET['IDobjet']))

		{
			global $bdd;
			$p_requete = $bdd->prepare('SELECT Titre, image, ISBN, Resume from objet where objet.IDobjet =:ID');

			$p_requete->execute(array('ID' => $_GET['IDobjet']));

			$p_requete2 = $bdd->prepare('SELECT Commentaire, etoiles from note where note.IDobjet =:ID');

			$p_requete2->execute(array('ID' => $_GET['IDobjet']));

			if($code_ISBN = $p_requete->fetch()){
				echo '<article>';
				echo "<h1>Fiche de " . $code_ISBN['Titre'] . "</h1>";
				echo '<div id="image">';
				?>
				<img src="<?php echo $code_ISBN['image'];?>"style="width:150px;height:300px;">
				<?php
				echo "</div>";
				echo "<div id='info'>";
				echo "<p>L'ISBN est : " . $code_ISBN['ISBN'] . '</p><br>';
				echo "<p>Résumé : " . $code_ISBN['Resume'] . '</p><br>';
			}
				if (estAdmin()){
					if ($code_ISBN_Commentaire = $p_requete2->fetch()){
						echo "<div id='annexe'><p>Commentaire : " . $code_ISBN_Commentaire['Commentaire'] . '</p><br>';
						echo "<p>Note : " . $code_ISBN_Commentaire['etoiles']. '</p><br>';
						echo '</div></div>';
				}
				else {
					echo "<div id='annexe'>Il n'y a pas encore de commentaire sur ce livre." . '<br>';
					echo "Il n'y a pas de note sur ce livre.";
					echo '</div></div>';

				}
					echo '<form method="post"><input type="submit" name="supprimer" value="Supprimer"><input type="submit" name="reserver" value="Réserver">';
					echo '<input type="hidden" name="IDobjet" value="' . $_GET["IDobjet"].'"></form>';
					echo '</div>';
					echo '</article>';
				}
			else if (estConnecte()){
				if ($code_ISBN_Commentaire = $p_requete2->fetch()){
					echo "<div id='annexe'><p>Commentaire : " . $code_ISBN_Commentaire['Commentaire'] . '</p><br>';
					echo "<p>Note : " . $code_ISBN_Commentaire['etoiles']. '</p><br>';
					echo '</div></div>';
			}
			else {
				echo "<div id='annexe'>Il n'y a pas encore de commentaire sur ce livre." . '<br>';
				echo "Il n'y a pas de note sur ce livre.";
				echo '</div></div>';
			}
				echo '<form method="post"><input type="submit" name="reserver" value="Réserver">';
				echo '<input type="hidden" name="IDobjet" value="'. $_GET["IDobjet"].'"></form>';
				echo '</article>';
			}
			}
		/*	else
			{
			echo 'Ne jouer pas avec les url';
		}*/
		if (isset($_POST['reserver'])){
			$date = date("Y-m-d");
			echo ($_GET['IDobjet'].' <br />');
			echo ($_SESSION['code'].' <br />');
			echo $date;
			/*
			$requete = $bdd->prepare('INSERT INTO reservation (IDobjet, IDutilisateur, Datedébut, Datefin, Emprunté, Rendu) VALUES (:IDobjet, :IDutilisateur, :Datedébut, :Datefin, 1, 0)');
			$requete->execute(array(
				'IDobjet' => $_GET['IDobjet'],
				'IDutilisateur' => $_SESSION['code'],
				'Datedébut' => $date,
				'Datefin' => $date
			));*/
		}
	if (estAdmin()){
		if (isset($_GET['nouveau'])){
			  echo '<title>Nouveau livre</title>
			    <h1>Nouveau livre</h1><br>';
			$donnees['titre'] = '';
			$donnees['ISBN'] = '';
			$donnees['auteur'] = '';
			$donnees['resume'] = '';

			echo '<form method="get">';
			echo '<table>';
			echo '<tr>';
			echo '<td><label for="nom">Titre :</label></td>';
			echo '<td><input type="text" name="titre" id="nom" value="' . $donnees['titre'] .'" required /></td>';
			echo "</tr>\n";

			echo '<tr>';
			echo '<td><label for="nom">ISBN :</label></td>';
			echo '<td><input type="text" name="isbn" id="isbn" value="' . $donnees['ISBN'] .'" required /></td>';
			echo "</tr>\n";

			echo '<tr>';
			echo '<td><label for="nom">Auteur	 :</label></td>';
			echo '<td><input type="text" name="auteur" id="auteur" value="' . $donnees['auteur'] .'"></td>';
			echo "</tr>\n";

			echo '<tr>';
			echo '<td><label for="nom">Résumé	 :</label></td>';
			echo '<td><input type="text" name="resume" id="resume" value="' . $donnees['resume'] .'"></td>';
			echo "</tr>\n";

			echo '<label for="icone">Couverture du livre</label><br />
				<input type="file" name="icone" id="icone" /><br />';

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
if (isset($_POST['valider'])){
  $p_requete = $bdd->prepare('INSERT INTO auteur (Nom) VALUES (:nom)');
  $p_requete->execute(array(
    'nom' =>$_GET['auteur']
  ));

  $p_requete2 = $bdd->prepare('INSERT INTO objet (image, Resume, Titre, ISBN ) VALUES (:img, :resume, :titre, :isbn)');
  $p_requete2->execute(array(
    'img' => $_FILES['icone']['name'],
    'isbn' => $_GET['isbn'],
    'titre' => $_GET['titre'],
    'resume' => $_GET['resume']
  ));

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
