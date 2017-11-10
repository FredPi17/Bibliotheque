<?php
function getRandom(){
  include ("connexion.php");
  function getRandom($nombre)
  /**
  *\author Hugo Lausenaz-Pire
  *\verificator Joseph Tabailloux
  *\enter La fonction prend en entré $nombre, étant le nombre de fois le tirage au sort
  *\brief Fonction qui tire au sort de nombre fois un id de livre
  *\test Regarder à partir de la ligne 43.
  *\return le tableau d'id de livre.
  */

  {
    global $bdd; /* J'importe la base de donnée en global de l'include connexion */
    $p_base = $bdd->query('SELECT count(*) as compteur from objet');
    /* Requête SQL qui compte le nombre de livre */

    $tab = []; /*Création d'un tableau que l'on va renvoyer */
    $cpt = 0; /* Initialisation d'un compteur */
    $limite = $p_base->fetch(); /* Je parcours ma requête SQL que je stocke dans limite */
    $count = $limite['compteur'];/* Limite étant un tableau, je stock un int dans count */
    if($count < $nombre) { /* Si nombre est plus grand que count, je sécure
      en diminuant nombre qui prend alors la valeur de count */
      $nombre = $count;
    }
    /* Tant que le compteur est inférieur au nombre de livres choisis */
    while ($cpt < $nombre)
    {
      $test = rand(1, $count); /* Je génère un random entre 1 et le nb de livre de ma base */
      $trouve = False; /* J'initialise trouve en false */
      foreach ($tab as $valeur) /* Je parcours mon tableau avec la variable valeur */
      {

        if ($test == $valeur) /* Si random généré est un id du tableaux: */
        {
            $trouve = True; /* Ma variable trouve est vrai */
        }
      }
      if (!$trouve) { /* Si je ne trouve pas, donc if test != valeur */
        $cpt++; /* Compteur +1 pour la boucle while */
        $tab[] = $test; /* Je met le nombre généré dans le tableau, pour obtenir
         enfin un id aléatoire */
      }
    }
    return $tab; /* Je renvoit le tableau avec les id générée aléatoirement. */
  }

  /* POUR TESTER LA FONCTION */

  $test = getRandom(1);
  var_dump($test);
}
 ?>
