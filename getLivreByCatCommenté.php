<?php
/** Fait par \Hugo Lausenaz-Pire et Joseph Tabailloux */
/**Fait le\14 décembre 2016*/
 include("connexion.php");
	function getLivreByCat($idCategorie)/** Le But de cette fonction est de choisir les Livres par Catégories.
	*\getLivreByCat[out]IDObjet en sortie prend le IDObjet qui est reliée au IDCategorie 
	*\getLivreByCat[in]$idCategorie prend en entrée l'idCategorie  de la base de donées (pour le moment seulement 1, 2 ou 3)
	*/
	{
		global $bdd; 
    $p_requete = $bdd->query("SELECT IDObjet from appartient
      where IDCategorie = ".$idCategorie);/** La requete*/

    $tab = [];/** On crée une variable de type table*/
		 while($reponse = $p_requete->fetch())/**Ici on fait tourner une boucle tant que ou la variable "reponse" prend tout le contenu de la *requete, on utilise le fetch() pour attraper la requete SQL*/
		{
			$tab = $reponse['IDObjet'];/**on stock la variable "reponse" dans la table "tab"*/
		}
		 $p_requete->closeCursor();/**Ici on dit d'arréter la requete SQL de la ligne 11*/
		 return $tab;/**On retourne le contenu de tab*/
	}
var_dump(getLivreByCat(1));/**Ici on fait apparaitre notre contenu de notre variable "tab"*/
?>
