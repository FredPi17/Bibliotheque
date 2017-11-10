<?php
  function estConnecte()
  /**
  *\author Hugo Lausenaz-Pire
  *\verificator Joseph Tabailloux
  *\brief renvoit vrai si l'utilisateur est connecté sinon renvoit faux
  * elle n'a pas de paramètres
  *\test Pour tester regarder à partir de la ligne 24.
  *\return ou faux selon la condition.
  */
  {
      if (isset($_SESSION['id'])) /* Si l'id de l'utilisateur existe,
                                  * il est connecté */
      {
        return true; /* Je renvois vrai */
      }
      else  /* Si l'id n'existe pas, l'utilisateur n'est pas connecté */
      {
        return false; /* Je renvois faux */
      }
  }

  /*
  Pour tester la fonction: enlever les '//' avant session start et $session pour
  voir si il y a une session ou non dans le site*/
  session_start();
  $_SESSION['id'] = 1;
   if (estConnecte())
  {
    echo "Est connecté";
  }
  else {
    echo "N'est pas connecté";
  }
 ?>
