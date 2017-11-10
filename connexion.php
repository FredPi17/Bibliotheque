<?php
include ('fonctions.php');
include ('include/carrousel.php');

//Affichage du menu
include ('header.php');

/*Importation de la fonction Menu*/
echo Menu();

//Connexion à la base de données
echo connexion();

//Affichage du Carrousel
//echo carrousel();
/* POUR TESTER LA FONCTION */
if (isset($_POST['connecter'])) {
  if (VerifLogin($_POST['adresse'], $_POST['mdp'])) {
    echo 'Bienvenue';
  }
  else {
    echo 'L\'adresse mail ou le mot de passe est incorrect';
  }
}

// FORMULAIRE EN HTML
echo '<form method="post">
  <label for="adresse">Adresse mail
     <input type="text" name="adresse" id="adresse"></br>
  </label>

  <label for="mdp">Mot de passe
    <input type="password" name="mdp" id="mdp"></br>
  </label>
  <p><a href="MotDePasseOublie.php">Mot de passe oublié ?</a></p>

  <input type="submit" name="connecter" value="Se connecter">
</form>';

//echo VerifLogin();
/*Détection si utilisateur est connecté*/
/*if  estconnecte() //Si utilisateur connecté
	echo siConnecte();
else //Sinon on affiche la liste random
	echo getRandom();*/

/*Affichage du Carrousel*/
/*echo carrousel($liste);*/

//Pied de page
echo piedPage();
?>
