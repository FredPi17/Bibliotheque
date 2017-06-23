<?php
/* -------------------- FONCTION GET LIVRE BY CAT() ------------------ */

/** Fait par \Hugo Lausenaz-Pire et Joseph Tabailloux */
/**Fait le\14 décembre 2016*/

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

  /* -------------------- FONCTION GET FAVORI() ------------------ */
  /* A FAIRE ET INTRODUIRE ICI */

  /* -------------------- FONCTION AFFICHE LIVRE() ------------------ */
  /* A FAIRE ET INTRODUIRE ICI */

  function getcategorie($IDobjet)/** Le but de cette fonction est d'affichr les catégories**/
  {
  global $bdd;
  $p_requete = $bdd->query('SELECT c.idCategorie, c.libelle from categorie c, appartient a where c.idCategorie = a.idCategorie and a.idObjet = ' . $IDobjet . '');/** La requête**/

  while($donnees = $p_requete->fetch())/** on fait tourner la boucle et le fetch attrape la requête sql**/
    {
      $tab = $donnees['c.idCategorie'];
      $tab = $donnees['c.libelle'];/** on stock la réponse dans le tableau**/
    }
    $p_requete->closeCursor();/** on stop la requête**/
    return $tab;/** on retourne le contenu du tableau **/
  }

  function getlivre($IDobjet)
  {
  global $bdd;
  $p_requete = $bdd->query('SELECT o.ISBN, o.titre, o.image, o.resume, o.image, a.nom from objet o, auteur a where o.IDAuteur = A.IDAuteur and o.IDobjet = ' . $IDobjet . '');

  while($donnees = $p_requete->fetch())
    {
        $tab = $donnees['IDobjet'];
        $tab = $donnees['o.ISBN'];
        $tab = $donnees['o.titre'];
        $tab = $donnees['o.image'];
        $tab = $donnees['o.resume'];
        $tab = $donnees['a.nom'];
        $tab = $donnees['$IDobjet'];
    }
    $p_requete->closeCursor();
    return $tab;
  }

  /* -------------------- FONCTION FICHE LIVRE() ------------------ */
  /* A FAIRE ET INTRODUIRE ICI */

  /* -------------------- FONCTION LISTE LIVRE() ------------------ */
  /* A FAIRE ET INTRODUIRE ICI */
 ?>
