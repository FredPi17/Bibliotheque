<?php
session_start();
include("include/outils.php");
include("include/utilisateur.php");
include("include/livre.php");
if (isset($_POST['inscription'])) {
  header('Location: inscription.php');
  die() ;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	  <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <title>Liste des livres</title>
	  <!-- Bootstrap -->

	  <link href="style/css/style.css" rel="stylesheet">
	  <link rel="stylesheet" href="style/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/css/listelivre.css">
    <link rel="stylesheet" href="style/css/foundation.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	  <!-- /**Le jquery ne se trouve pas dans le download boot strap on est obligé de le récupérer enligne!*/-->
	  <script src="js/bootstrap.min.js"></script>
</head>
<title>Liste des livres</title>
<meta charset="utf-8"/>

<?php
echo menuConnexion();
echo Menu();
if(isset($_GET['msg'])){
	echo '<h3>'.htmlentities($_GET['msg']).'</h3>';
}

try {
	echo '<div class="row medium-up-1 small-up-1 large-up-1">
          <div class="column">
            <h1>Liste des livres</h1>'."\n";
	echo       '<table>'."\n"; /*ouvre le tableau*/
	echo         '<tr><th>Image</th><th>Auteur</th><th>Titre</th>' ."\n";/*nom des colonnes*/
	$reponse = $bdd->query('SELECT image, objet.IDobjet as IDobjet, auteur.Nom, objet.Titre, objet.image from objet, auteur where auteur.IDauteur = objet.IDauteur');
	// On affiche chaque entrée une à une

	while ($donnees = $reponse->fetch()) {
    if (estConnecte()){
    ?>
    <tr><td><img src="<?php echo $donnees['image'];?>"style="width:100px;height:150px;"></td>
    <?php
    echo '</td><td>'. $donnees['Nom'];
    echo '</td><td><a href="fichelivre.php?IDobjet=' . $donnees['IDobjet'] . '">' . $donnees['Titre'] . '</a></td></tr>' ;
		echo '<form action="nouveauLivre.php" method="get">
			<input type="hidden" name="livre" value.= '. $donnees['Titre'];
      }
    else{
      ?><tr><td><img src="<?php echo $donnees['image'];?>"style="width:100px;height:150px;"></td>
      <?php echo '<td>'. $donnees['Nom'] . '</td><td> ' .$donnees['Titre'] . '</a></td></tr>' ;

    }
	}
  if(estAdmin()){
  echo '<tr><td></td><td></td><td><input type="submit" name="nouveau" value="Nouveau"></td></tr>';
  }
  echo '</form>';
	$reponse->closeCursor(); // Termine le traitement de la requête
	echo '</table></div></div>';
} catch(Exception $e) {
	// En cas d'erreur précédemment, on affiche un message et on arrête tout
	die('Erreur : '.$e->getMessage());
}
echo piedPage();
?>
