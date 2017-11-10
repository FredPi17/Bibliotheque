<!-- PAGE DE CONNEXION -->
<!-- CONTIENT:
    - Fonction VerifLogin
    - Un Test de la fonction qu'on peut laisser
    - Le formulaire en html-->
<?php
include("connexion.php");
function VerifLogin($mail, $pw)
{
  /**
  *\author Hugo Lausenaz-Pire
  *\verificator Joseph Tabailloux & Frédéric Pinaud
  *\brief Vérifie si le mail et le mdp correspond à la BDD
  * Prend en paramètre le mail et le mot de passe
  *\return un id si ça correspond sinon un false
  */
  global $bdd; /* J'importe la base de donnée */

    /* Je prépare ma requête SQL, je select le mail et le mdp de l'utilisateur */
    $p_seco = $bdd->prepare('SELECT Mail, MDP from utilisateur
      where  Mail =:mail and MDP =:mdp');

    /* Comme j'ai fait un prepare, je fait un execute avec les valeurs d'entrée */
    $p_seco->execute(array('mail' => $mail, 'mdp' => $pw));
    /* Je vais chercher mes données avec un fetch */
    $id = $p_seco->fetch();

    /* Si j'ai quelques chose avec mon fetch alors c'est l'id de l'utilisateur */
    if ($id) {
      return $id; /* Je renvoit l'id de l'utilisateur, donc l'utilisateur est connecté */
    }
    else { /* Sinon cela ne correspond pas à un compte utilisateur */
      sleep(1); /* Je ralenti un peu pour éviter les logiciels malveillant qui lance automatiquement bcp de test */
      return False; /* Je renvoit false ce qui veut dire que l'utilisateur n'a pas pu se connecter */
    }
}

/* POUR TESTER LA FONCTION */
if (isset($_POST['connecter'])) {
  if (VerifLogin($_POST['adresse'], $_POST['mdp'])) {
    echo 'Bienvenue';
  }
  else {
    echo 'L\'adresse mail ou le mot de passe est incorrect';
  }
}
  
// FORMULAIRE EN HTML
echo '<form method="post">
  <label for="adresse">Adresse mail
	   <input type="text" name="adresse" id="adresse"></br>
  </label>

  <label for="mdp">Mot de passe
    <input type="password" name="mdp" id="mdp"></br>
  </label>
  <p><a href="MotDePasseOublie.php">Mot de passe oublié ?</a></p>

  <input type="submit" name="connecter" value="Se connecter">
</form>';
?>
