<?php

 include("connexionBDD.php");          /*j'inclue ma fonction   */           											/* Date du commentaire 13/12/2016 */                   

	function getFavoriteCategorie($idUtilisateur)        /* je cree ma fonction  */

	{

		global $bdd;                                                     /* Me permet de me connecter a ma base   */



		 $p_requete = $bdd->query('SELECT count(*) as cpt, a.idCategorie as idcategorie     /* MA requete SQl */

		 from appartient a, objet o, reservation r

		 where a.idObjet = o.idObjet and o.idObjet = r.idObjet

		  and r.idUtilisateur = ' . $idUtilisateur . '

			 group by idCategorie

			 order by cpt desc limit 1');                                                   /* Qui va jusque la */





		 while($donnees = $p_requete->fetch())                                

		 {

		 $valeur = $donnees['idcategorie'];

		}

		return $valeur;

	}

echo getFavoriteCategorie(1);                    /*ceci sert a tester ma fonction  */

?>