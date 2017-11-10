
<?php
/** \fait par Hugo, Frederic, Loris*/
/*date14/12/2016*/
/* permet d'afficher la fiche détail de chaque livre*/
/*il faut encore réaliser un foreach pour afficher tous les commentaires et toutes les notes, pas seulement une de chaque*/

require_once("include/outils.php"); /*appel la fonction pour se connecter*/
include("include/utilisateur.php");
session_start();
if(isset($_GET['IDobjet']))
	{
		global $bdd;
		$p_requete = $bdd->prepare('SELECT Titre, image, ISBN, Resume from objet where objet.IDobjet =:ID');
		$p_requete->execute(array('ID' => $_GET['IDobjet']));
		if($requete = $p_requete->fetch()){
			$Titre = $requete['Titre'];
			$image = $requete['image'];
			$ISBN = $requete['ISBN'];
			$Resume = $requete['Resume'];
		}

		$p_requete2 = $bdd->prepare('SELECT Commentaire, etoiles from note where note.IDobjet =:ID');
		$p_requete2->execute(array('ID' => $_GET['IDobjet']));
		if($requete2 = $p_requete2->fetch()){
			$commentaire = $requete2['Commentaire'];
			$etoiles = $requete2['etoiles'];
		}
		else{
			$commentaire = "Il n'y a pas encore de commentaire pour ce livre";
			$etoiles = "Aucune étoile pour le moment";
		}

		$p_requete3 = $bdd->prepare('SELECT Nom from auteur, objet where auteur.IDauteur = objet.IDauteur AND objet.IDobjet = :ID');
		$p_requete3->execute(array('ID' => $_GET['IDobjet']));
		if($requete3 = $p_requete3->fetch()){
			$Nom = $requete3['Nom'];
		}

		$p_requete4 = $bdd->prepare('SELECT Emprunté from reservation where reservation.IDobjet = :ID');
		$p_requete4->execute(array('ID' =>$_GET['IDobjet']));
		if($requete4 =$p_requete4->fetch()){
			$emprunte = $requete4['Emprunté'];
		}
		else $emprunte = 0;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<title><?php echo $Titre; ?></title>
<link href="style/css/style.css" rel="stylesheet">
<link href="style/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style/css/foundation.css">
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
?>
<div class="ui main container" id="menu">
	<div class="row">
		<div class="callout">
			<div class="row">
				<div class="large-12 columns">
					<h1> <?php echo $Titre; ?></h1>
					<div class="large-4 columns">
						<div id="image">
							<img src="<?php echo $image;?>"style="width:200px;height:300px;">
						</div>
					</div>
					<div class="large-8 columns">
						<div id='info'>
							<span>Auteur: <?php echo $Nom; ?></span><br />
							<span>L'ISBN est : <?php echo $ISBN; ?></span><br>
							<span>Résumé : <?php echo $Resume; ?></span><br>

							<div id='annexe'><p>Commentaire : <?php echo $commentaire; ?></p><br>
								<p>Note : <?php echo $etoiles; ?></p><br>
							</div>
						</div>
					</div>
				</div>
			</div>
					<div class="row">
						<div class="callout">
							<div class="row">
								<div class="large-12 columns">
				<?php
				if (estAdmin()){?>
					<div class="large-6 columns"style="text-align:right;">
						<form method="post"><input type="submit" name="supprimer" value="Supprimer">
					</div>
					<div class="large-6 columns" style="text-align:left;">
						<?php if(!$emprunte){?>
						<input type="submit" name="reserver" value="Réserver">
						<?php }
						else{
							echo "Ce livre est déja réservé !";
						}?>
					</div>
					<input type="hidden" name="IDobjet" value=" <?php echo $_GET["IDobjet"]; ?>"></form>
					</div>
					</article>
					<?php
				}
			elseif (estConnecte()){?>
				<div class="large-12 columns" style="text-align:center;">
					<form method="post">
						<?php if(!$emprunte){?>
						<input type="submit" name="reserver" value="Réserver">
						<?php }
						else{
							echo "Ce livre est déja réservé !";
						}?>
					<input type="hidden" name="IDobjet" value="<?php echo $_GET["IDobjet"]; ?>"></form>
				</div>
				<?php
			}
			}

			else
			{
			echo 'Ne jouer pas avec les url';
		}



		if (isset($_POST['reserver'])){
			$objet = $_GET['IDobjet'];
			$utilisateur = $_SESSION['code'];
			$date_plus = date("Y-m-d", strtotime('now +7 days'));
			$date = date("Y-m-d");
			global $bdd;
			$reservation = $bdd->query("INSERT INTO reservation (IDobjet, IDutilisateur, Datedébut, Datefin, Emprunté) VALUES ($objet, $utilisateur, '$date', '$date_plus', 1)");
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

			echo '<label for="icone">Couverture du livre</label>
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
/*
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

}*/

if (isset($_POST['supprimer'])){
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
