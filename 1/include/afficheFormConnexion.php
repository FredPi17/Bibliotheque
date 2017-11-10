<?php
  function afficheFormConnexion()
  /**
  *\author Hugo Lausenaz-Pire
  *\verificator Joseph Tabailloux
  *\brief affecte une valeur à un formulaire de connexion avec un titre h1
  * Pas de paramètre
  *\return return le formulaire sous forme de string
  *\Test Regarder à la fin de la fonction
  */
  {
    $echo = '
    <!-- FORMULAIRE EN HTML  -->
    <h1>Connexion</h1>
    <form method="post">
      <label for="adresse">Adresse mail
    	   <input type="text" name="mail" id="mail"></br>
      </label>

      <label for="mdp">Mot de passe
        <input type="password" name="mdp" id="mdp"></br>
      </label>

      <input type="submit" name="connecter" value="Se connecter">
    </form>';
    return $echo;
  }
  /* TESTER LA FONCTION
  echo afficheFormConnexion();*/
 ?>
