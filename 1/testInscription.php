<?php
define("DB_SERVER", "localhost");
define("DB_BASE", "bibliotheque");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define('DB_SALT', 'Les5G');

$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_BASE, DB_USER, DB_PASSWORD, $pdo_options);
$bdd->exec("Set character set utf8");

echo afficheFormInscription();
/*
$tab = array();
$tab = $_POST['mail'];
$tab = $_POST['mdp'];
$tab = $_POST['mdpC'];
$tab = $_POST['prenom'];
$tab = $_POST['nom']; */

if(isset($_POST['inscription'])){
  echo ajouteUtilisateur($_POST);
}
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
    <div class="container-full">
      <div class="row">
        <div class="col-lg-12 text-center v-center">
          <form method="post" class="col-lg-12">
            <div class="input-group" style="width:340px;text-align:center;margin:0 auto;">

              <h1>Inscription</h1>
              <h3>Tous les champs sont obligatoire !</h3>
              <label for="mail">Mail
              <input type="text" name="mail" id="mail" class="form-control">
              </label>

              <label for="mdp">Mot de passe
                <input type="password" name="mdp" id="mdp" class="form-control"></br>
              </label>

              <label for="mdpC">Confirmation du mot de passe
              <input type="password" name="mdpC" id="mdpC" class="form-control"></br>
              </label>

              <label for="prenom">Prénom
              <input type="text" name="prenom" id="prenom" class="form-control">
              </label>

              <label for="nom">Nom
              <input type="text" name="nom" id="nom" class="form-control">
              </label>
              <span class="input-control input-lg">
                <input type="submit" class="btn btn-lg btn-primary" name="inscription" value="inscription" id="Submit_connexion">
              </span>
              <span class="input-control input-lg">
                <input type="submit" class="btn btn-lg btn-primary" name="retour" value="Retour" id="Submit_retour">
              </span>
            </div>
          </form>
        </div>
      </div>
    </div>
    ';
    return $echo;
  }

  function ajouteUtilisateur($tab)
  {
    /**
    *\author Hugo Lausenaz-Pire
    *\verificator Joseph Tabailloux
    *\brief C'est un requete INSERT
    * Tableau du post inscription
    *\return l'identifiant de l'utilisateur
    *\Test Regarder le inscription.php
    */
    global $bdd;

    $NewPassword = sha1($tab['mdp'] . DB_SALT . strtolower($tab['mail']));

    $p_requeteInsert = $bdd->prepare( 'INSERT INTO utilisateur (MDP, Mail, Nom, Prenom, Admin)
      VALUES ( :mdp, :Mail, :nom, :prenom, :admin  )'
    );
      $p_requeteInsert->execute(array(
        'Mail' => $tab['mail'],
        'mdp' => $NewPassword,
        'prenom' => $tab['prenom'],
        'nom' => $tab['nom'],
        'admin' => False
      ));
      $ID = $bdd->lastInsertId();
      return $ID;
  }

?>
