<?php
  function estAdmin()
  /**
  *\author Hugo Lausenaz-Pire
  *\verificator Joseph Tabailloux
  *\brief renvoit vrai si l'administrateur est connecté sinon renvoit faux
  * elle n'a pas de paramètres
  *\Test pour tester la fonction regarder à partir de la ligne 21
  *\return vrai ou faux selon la condition.
  */
  {
    if (isset ($_SESSION['admin'])) { /* Si l'admin de la session existe,
                                * il est connecté */
      return true;   /* Je renvois vrais */
    }
    else {  /* Sinon la session administrateur n'est pas ouverte */
      return false;  /* Je renvois faux */
    }
  }

/* Pour tester la fonction, enlever les '//' devant sessionstart et $_SESSION.*/
 /* session_start();
  $_SESSION['admin'] = 1 ;
  if (estAdmin()) {
    echo "L'administrateur est connecté";
  }
  else {
    echo "L'administrateur n'est pas connecté";
  }*/
 ?>
