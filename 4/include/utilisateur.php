<?php

/* -------------------- FONCTION EST CONNECTE() ------------------ */
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
      if (isset($_SESSION['code'])) /* Si l'id de l'utilisateur existe,
                                  * il est connecté */
      {
        return true; /* Je renvois vrai */
      }
      else  /* Si l'id n'existe pas, l'utilisateur n'est pas connecté */
      {
        return false; /* Je renvois faux */
      }
  }

  /* -------------------- FONCTION EST ADMIN() ------------------ */

  function estAdmin(){
    if(isset($_SESSION['code'])){

        if (($_SESSION['admin']) == '1'){
          return True;
        }
        else {
          return False;
        }
    }
    else {
      return False;
    }
  }

  /*--------------------- FONCTION CONNEXION ------------------------------------*/
function connexion(){
  global $bdd;

  $p_requeteConnexion = $bdd->prepare('SELECT IDutilisateur, MDP, Mail, Nom, Prenom, Admin
                                          FROM utilisateur
                                          WHERE lower(Mail) = :mail');
  $p_requeteConnexion->execute(array(
    'mail' => $_POST['login']));

  if ($id = $p_requeteConnexion->fetch())
  {
    if ($id['MDP'] == sha1($_POST['mdp'] . DB_SALT . strtolower($_POST['login']))) {
      $_SESSION['code'] = $id['IDutilisateur'];
			$_SESSION['login'] = $id['Prenom'];
			$_SESSION['admin'] = $id['Admin'];

    }
  }
}

/*------------------------FONCTION DECONNEXION ----------------------------------- */
function Deconnexion(){
		 unset($_SESSION['code']);
		 unset($_SESSION['login']);
		 $_SESSION['admin'] = '0';
     header('Location: index.php');
     die();
	 }

/*----------------------FONCTION menuConnexion*/

function menuConnexion(){
if(isset($_POST['connecter']))
		{ // Si clic sur le bouton Connexion ...
	 Connexion();
		} // ...Appel à la fonction de connexion
	if(isset($_POST['deconnexion']))
		{ // Si clic sur le bouton Déconnexion ...
		Deconnexion();
		}
	if(empty($_SESSION['code'])){
    $_SESSION['droits']='0';
    echo '
    <nav>
      <form method="post" >
        <label for="login">E-mail
          <input type="email" name="login" id="login"><br />
        </label>
        <label for="mdp">Mot de passe
          <input type="password" name="mdp" id="mdp"><br />
        </label>
          <input type="submit" name="connecter" value="Se connecter" id="Submit_connexion">
          <input type="submit" name="inscription" value="Inscription" id="Submit_inscription">
      </form>
    </nav>';
    }
    if (isset($_SESSION['code'])){
      echo '<div id="connexion">';
      echo "Vous etes connecté en tant que " . $_SESSION['login'];
      echo '<form method="post">';
      echo '<tr><input type="submit" name="deconnexion" value="deconnecter"></tr>';
      echo '</form>';
      echo '</div>';
    }

}
  /* -------------------- FONCTION GET FAVORITE CATEGORIE() ------------------ */

  function getFavoriteCategorie($idUtilisateur)   /* je cree ma fonction  */

  {
    global $bdd;          /* Me permet de me connecter a ma base   */
    $p_requete = $bdd->query(
    'SELECT count(*) as cpt, a.idCategorie as idcategorie     /* MA requete SQl */
    FROM appartient a, objet o, reservation r
    WHERE a.idObjet = o.idObjet AND o.idObjet = r.idObjet
    AND r.idUtilisateur = ' . $idUtilisateur . '
    group by idCategorie
    order by cpt desc limit 1');                                                   /* Qui va jusque la */

    while($donnees = $p_requete->fetch())
    {
      $valeur = $donnees['idcategorie'];
    }
    return $valeur;
  }


  /* -------------------- FONCTION (AFFICHE) CARROUSEL() ------------------ */

    function carrousel(){
  $echo = '
  <div class="container">
<br>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li> <!--noublie pas dajouter une nouvelle ligne si tu veut des diapo en plus!-->
  </ol>

  <!-- Met tes photos ici -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="image/1.jpg" alt="Chania" width="460" height="345"> <!-- Met tes photos dans les /a img src, et règle la hauteur que tu veut! -->
    </div>

    <div class="item">
      <img src="image/2.jpg" alt="The Muscles From Brussels" width="460" height="345">
    </div>

    <div class="item">
      <img src="image/3.jpg" alt="The Ostritch from Austria" width="460" height="345">
    </div>

    <div class="item">
      <img src="image/4.jpg" alt="The Chuck" width="460" height="345">
    </div>
  </div>

</div>
</div>
';
return $echo;
  }

  /* -------------------- FONCTION GET ID UTILISATEUR() ------------------ */
function GetIDUtilisateur($login, $password)
/**
*\author Hugo Lausenaz-Pire
*\verificator Joseph Tabailloux & Frederic Pinaud
*\brief renvoit vrai si le login et le mdp correspond à un utilisateur de la BDD
* login et password, sont deux paramètres, correspond respectivement au mail et au mdp de l'utilisateur
*\Test Regarder à la fin de la fonction
*\return l'id de l'user si il existe sinon faux.
*/
{
global  $bdd;

$p_requeteID = $bdd->prepare('SELECT IDutilisateur FROM utilisateur WHERE Mail = :login AND MDP = :pw');
$p_requeteID->execute(array(
  'login' => $login,
  'pw' => sha1($password . DB_SALT . strtolower($login))
));
if ($ID = $p_requeteID->fetch()) {
  return $ID['IDutilisateur'];
}
else {
  return False;
}


  /* -------------------- FONCTION AFFICHE FORM CONNEXION() ------------------ */
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

  /* -------------------- FONCTION AFFICHE FORM INSCRIPTION() ------------------ */
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
          <form method="get" class="col-lg-12">
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

  function afficheFormNouveau()
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
              <div class="input-group" style="width:340px;margin:0 auto;">
                <h1>Nouvel utilisateur</h1>
                <h3>Tous les champs sont obligatoire !</h3>

                <label for="prenom">Prénom
                <input type="text" name="prenom" id="prenom" class="form-control">
                </label>

                <label for="nom">Nom
                <input type="text" name="nom" id="nom" class="form-control">
                </label>


                <label for="mail">Mail
                <input type="text" name="mail" id="mail" class="form-control">
                </label>

                <label for="mdp">Mot de passe
                  <input type="password" name="mdp" id="mdp" class="form-control"></br>
                </label>

                <label for="mdpC">Confirmation du mot de passe
                <input type="password" name="mdpC" id="mdpC" class="form-control"></br>
                </label>

                <label for="admin">Administrateur
                <input type="radio" name="admin"value="1">Oui
                <input type="radio" name="admin" value="0"checked>Non</br></label>

                <span class="input-control input-lg">
                  <input type="submit" class="btn btn-lg btn-primary" name="nouveau" value="Nouveau" id="Submit_connexion">
                </span>
                <span class="input-control input-lg">
                  <input type="submit" class="btn btn-lg btn-primary" name="retour" value="Annuler" id="Submit_retour">
                </span>
              </div>
            </form>
          </div>
        </div>
      </div>
      ';
      return $echo;
    }
  /* POUR TESTER LA FONCTION
  echo afficheFormInscription();
  */

  /* -------------------- FONCTION CONTROLE FORM INSCRIPTION() ------------------ */
  function controleFormInscription()
  /**
  *\author Hugo Lausenaz-Pire
  *\verificator Joseph Tabailloux
  *\brief affecte une valeur à un formulaire de connexion avec un titre h1
  * Pas de paramètre
  *\return return le formulaire sous forme de string
  *\Test Regarder à la fin de la fonction
  */
  {
    session_start();
    global $bdd;
    $NewPassword = sha1($_GET['mdp'] . DB_SALT . strtolower($_GET['mail']));
    $p_requeteInsert = $bdd->prepare('INSERT INTO utilisateur (MDP, Mail, Nom, Prenom, Admin, image) VALUES ( :mdp, :Mail, :nom, :prenom, :admin, "image/default.png" )');
      $p_requeteInsert->execute(array(
        'Mail' => $_GET['mail'],
        'mdp' => $NewPassword,
        'prenom' => $_GET['prenom'],
        'nom' => $_GET['nom'],
        'admin' => 0
      ));
      header('Location:index.php');
      die();
  }
 ?>
