<?php
  function afficheFormInscription()
  /**
  *\author Hugo Lausenaz-Pire
  *\verificator Joseph Tabailloux & Frédéric Pinaud
  *\brief affecte une valeur à un formulaire d'inscription avec un titre h1 et un sous titre h3s
  * Pas de paramètre
  *\return return le formulaire sous forme de string
  *\Test Regarder à la fin de la fonction
  */
  {
    $echo = '
    <div>
      <form method="post">
        <h1>Inscription</h1>
        <h3>Tous les champs sont obligatoire !</h3>

        <label for="mail">Mail
          <input type="text" name="mail" id="mail">
        </label>

        <label for="mdp">Mot de passe
          <input type="text" name="mdp" id="mdp">
        </label>

        <label for="mdpC">Confirmation du mot de passe
          <input type="text" name="mdpC" id="mdpC">
        </label>

        <label for="prenom">Prénom
          <input type="text" name="prenom" id="prenom">
        </label>

        <label for="nom">Nom
          <input type="text" name="nom" id="nom">
        </label>

        <input type="submit" name = "inscription" value="S\'inscrire">
      </form>
    </div>
    ';
    return $echo;
  }
  /* POUR TESTER LA FONCTION
  echo afficheFormInscription();
  */
 ?>
