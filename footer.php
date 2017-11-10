<?php
  function piedPage()
  /**
  *\author Hugo Lausenaz-Pire
  *\verificator Joseph Tabailloux
  *\brief renvoie une valeur qui contient le bas de la page
  * elle n'a pas de paramaètres
  *\return un string $piedpage qu'il faudra afficher.
  */
  {
    $piedpage = '<footer>
                    <p>Site réalisé par les B1 EPSI Grenoble, 2016-2017,
                    <a href="#">CGU</a></p>
                </footer>
                </body>';
                /* Création de $piedpage qui contient du texte
                * et un lien hypertexte, possible de mettre des images */
                return $piedpage; /* Je renvoit $piedpage (le bas de la page) */
  }
?>
