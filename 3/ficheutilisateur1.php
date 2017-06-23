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
		<li><a href="listeutilisateur1.php">Retour liste utilisateur</a></li>
	</ul>
	</nav>
</header>

<?php
echo '<h1>nouveau</h1>'."\n";
echo '<table><form method="post">'."\n";
	if(isset($_GET['IDutilisateur']))

		{
			global $bdd; 
			$p_requete = $bdd->prepare('SELECT Nom, Prenom, Mail from utilisateur where utilisateur.IDutilisateur =:ID'); 

			$p_requete->execute(array('ID' => $_GET['IDutilisateur']));

			if($code_utilisateur = $p_requete->fetch()){
				echo "Le nom est : " . $code_utilisateur['Nom'] . '<br>';
				echo "Le prenom est : " . $code_utilisateur['Prenom'] . '<br>';
				echo "Le mail est : " . $code_utilisateur['Mail'] . '<br>';
			}
			else 
			{
			echo 'Ne jouer pas avec les url'; 
			}
		}
		if(isset($_POST['valider'])) {

$NewPassword = sha1($_POST['MDP'] . DB_SALT . strtolower($_POST['Mail']));
$p_requete = $bdd->prepare(
            'INSERT INTO utilisateur (Nom, Prenom, Mail, MDP)
            VALUES ( :Nom, :Prenom, :Mail, :MDP)');
            $p_requete->execute(array(
                'Nom' => $_POST['Nom'],
                'Prenom' => $_POST['Prenom'],
                'Mail' => $_POST['Mail'],
                'MDP' => $NewPassword
            ));
	echo 'Création enregistrée';
	$value = $bdd->LastInsertId();
	echo header('Location: listeutilisateur1.php');
	die();
}

if(isset($_POST['annuler']))
{
	echo header('Location: listeutilisateur1.php?');
	die();
}
if(isset($_POST['nouveau']))
	{
	$ligne['Nom'] = '';
	$ligne['Prenom'] = '';
	$ligne['Mail'] = '';
	$ligne['MDP'] = '';
		echo '<tr>';
		echo '<td><label for="nom">Nom :</label></td>';
		echo '<td><input type="text" name="Nom" id="nom" value="' . $ligne['Nom'] .
		'"></td>';
		echo "</tr>\n";
		echo '<tr>';
		echo '<td><label for="prenom">Prenom :</label></td>';
		echo '<td><input type="text" name="Prenom" id="prenom" value="' . $ligne['Prenom'] .
		'"></td>';
		echo "</tr>\n";
		echo '<tr>';
		echo '<td><label for="mail">Mail :</label></td>';
		echo '<td><input type="text" name="Mail" id="mail" value="' . $ligne['Mail'] .
		'"></td>';
		echo "</tr>\n";
		echo '<tr>';
		echo '<td><label for="mdp">MDP :</label></td>';
		echo '<td><input type="password" name="MDP" id="mdp" value="' . $ligne['MDP'] .
		'"></td>';
		echo "</tr>\n";
		echo '<tr>';
		echo '<td><input type="submit" name="annuler" value="Annuler"</td>';
		echo '<td><input type="submit" name="valider" value="Valider"</td>';
		echo '</form>';
		
		echo '</table>';

	}

?>
</body>
</html>