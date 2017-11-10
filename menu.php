<?php
  function Menu()
  /**
  *\author Hugo Lausenaz-Pire
  *\verificator Joseph Tabailloux
  *\brief affiche le menu selon certaines conditions
  * elle n'a pas de paramaètres
  *\return un string $menu qu'il faudra afficher.
  * (conseil hugo)Pour afficher le menu: echo Menu(), la fonction ne marche pas
  *si on n'a pas la fonction estConnecte()
  */
  {
    $menu = "";/* Déclaration de ma variable menu string  */

    $menu .= '<nav>
                <ul>
                  <li><a href ="index.php">Accueil</a></li>
                  <li><a href ="listelivre.php">Livres</a></li>';
                  /* Je concatène le début d'une liste à puce */
    if (estConnecte()) /* Si la fonction estConnecte renvoie vrai alors: */
    {
      $menu .= '<li>
      <a href="ficheUtilisateur.php?id='. $_SESSION['id'] .'">Profil</a>
                </li>';
                /* Comme l'utilisateur est connecté je concatene $menu avec
                * une nouvelle puce "Profil" */
    }
    else {
      $menu .= '<li>
                  <a href="inscription.php">Se connecter</a>
                </li>';
                /* Sinon l'utilisateur n'est pas connecté, je concatene $menu
                * pour ajouter une puce "Se connecter" */
    }
    $menu .= '</ul>
            </nav>';
    /* Je concatène $menu pour fermer la liste à puce et je ferme la balise nav */
    return $menu; /* Je renvoit $menu le menu donc. */
  }
?>
