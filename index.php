<?php
include ('fonctions.php');
include ('carrousel.php');

//Affichage du menu
include ('header.php');

/*Importation de la fonction Menu*/
echo Menu();

//Connexion à la base de données
//echo connexion();

//Affichage du Carrousel
echo carrousel();

/*Détection si utilisateur est connecté*/
if (estConnecte()) //Si utilisateur connecté
  echo getFavoris();
else //Sinon on affiche la liste random
	echo getRandom(3);

/*Affichage du Carrousel*/
/*echo carrousel($liste);*/

//Pied de page
echo piedPage();
?>
