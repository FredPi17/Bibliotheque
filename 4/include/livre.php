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

	function listeCat($cat)
	{
		global $bdd ;
		$echo = "<select id='cat1' name='cat1'>";
		$p_reponse = $bdd->query("select IDcategorie, Libelle from categories");
		while ($import = $p_reponse->fetch())
		{
			$echo .=  '<option value="' . $import['IDcategorie'] .'"';
					if ($import['IDcategorie'] == $cat)
						$echo.= 'selected="selected"';
						$echo.='>'.$import['Libelle'].'</option>';
		}
		$echo .= '</select>';
		return $echo;
	}

	function listeAuteur($auteur)
	{
		global $bdd ;
		$echo = "<select id='auteur1' name='auteur1'>";
		$p_reponse = $bdd->query("select Nom, IDauteur from auteur");
		while ($import = $p_reponse->fetch())
		{
			$echo .=  '<option value="' . $import['IDauteur'] .'"';
					if ($import['IDauteur'] == $auteur)
						$echo.= 'selected="selected"';
						$echo.='>'.$import['Nom'].'</option>';
		}
		$echo .= '</select>';
		return $echo;
	}

	function nouveauLivre(){
		$auteur = '';
		$idAuthor = '';
		$categorie = '';
		global $bdd;
		$upload = true;
		if (isset($_GET['envoyer'])){
			$last=$bdd->query('SELECT IDobjet from objet ORDER BY IDobjet DESC LIMIT 1');
			while ($donnees = $last->fetch()){
				$idObjet = $donnees['IDobjet'];
			}
			if ($idObjet == NULL){
				$idObjet = 1;
			}
			else{
				$idObjet += 1;
			}


		/* début vérification de la présence de auteur2 ou de auteur1 */
		if($_GET['auteur2'] == NULL)
		{
		  $idAuthor = $_GET['auteur1'];
			$auteur = '';
			$import=$bdd->prepare('SELECT Nom from auteur where IDauteur = :auteur');
			$import->execute(array(
				'auteur' => $idAuthor
			));
			while($donnees = $import->fetch()){
				$auteur = $donnees['Nom'];
			}
		}
		else
		{
			$auteur = $_GET['auteur2'];
			$idAuthor ='';
			$last=$bdd->query('SELECT IDauteur from auteur ORDER BY IDauteur DESC LIMIT 1');
			while ($donnees = $last->fetch()){
					$idAuthor = $donnees['IDauteur'];
				}
				if ($idAuthor == NULL){
					$idAuthor = 1;
				}
				else{
					$idAuthor += 1;
					$p_requeteAddAuthor = $bdd->prepare('INSERT INTO auteur (Nom, IDauteur) VALUES (:nom, :ID)');
				 	$p_requeteAddAuthor->execute(array(
						'nom' => $auteur,
						'ID' => $idAuthor
					));
				}
		}
		/* fin de vérification */

			/* On récupère le dernier IDauteur et on lui ajoute +1*/

	}
			/* Sinon on récupère le Nom qui correspond à $idAuthor*/

		/* debut de vérification de la présence de cat2 ou de cat1 */
		if($_GET['cat2'] == NULL)
		{
		  $idCategorie = $_GET['cat1'];
			$import=$bdd->prepare('SELECT Libelle from categories where IDcategorie = :categorie');
			$import->execute(array(
				'categorie' => $idCategorie
			));
			while($donnees = $import->fetch()){
				$categorie = $donnees['Libelle'];
			}
			$newCategorie = false;
			$categorie = '';
		}
		else
		{
			$categorie = $_GET['cat2'];
			$last=$bdd->query('SELECT IDcategorie from categories ORDER BY IDcategorie DESC LIMIT 1');
			while ($donnees = $last->fetch()){
				$idCategorie = $donnees['IDcategorie'];
			}
			if ($idCategorie == NULL){
				$idCategorie = 1;
			}
			else{
				$idCategorie += 1;
			}
			$p_requeteAddCat = $bdd->prepare('INSERT INTO categories (Libelle) VALUES (:libelle)');
			$p_requeteAddCat->execute(array(
				'libelle' => $categorie
			));
		}
		/* fin de vérification  */
		$AddAppartient = $bdd->prepare("INSERT INTO appartient (IDobjet, IDcategorie) VALUES (:IDobjet, :IDcategorie)");
		$AddAppartient->execute(array(
			'IDobjet' => $idObjet,
			'IDcategorie' => $idCategorie
		));

		/* debut de vérification de la longueur de l'isbn, il doit faire 10 caracteres de long */
		/* fin de vérification*/
		if(strlen($_GET['titre']) < 3)
		{
		  echo"Vous n'avez pas rentré de titre";
		  $upload = false;
		}

		$p_requeteAddBook = $bdd->prepare('INSERT INTO objet (/*image,*/ Resume, Titre, ISBN, IDauteur ) VALUES (/*:img,*/ :resume, :titre, :isbn, :IDauteur)');
		$p_requeteAddBook->execute(array(
			//'img' => $target_file,
			'resume' => $_GET['resume'],
			'titre' => $_GET['titre'],
			'isbn' => $_GET['isbn'],
			'IDauteur' => $idAuthor
		));
		/* Si le variable $upload est à vraie, on fait ceci */

			/* Si $auteur_status est à vraie */


/*
		  $p_requeteSelectBook = $bdd->query('SELECT ISBN from objet');
		  while ($ListISBN = $p_requeteSelectBook->fetch()) {
		    if($ListISBN["ISBN"] == $_GET['isbn'])
		    {
		      $uploadBook = false;
		    }
		    else {
		      $uploadBook = true;
		    }
		  }
*/








		  }
  /* -------------------- FONCTION FICHE LIVRE() ------------------ */
  /* A FAIRE ET INTRODUIRE ICI */

  /* -------------------- FONCTION LISTE LIVRE() ------------------ */
  /* A FAIRE ET INTRODUIRE ICI */
 ?>
