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

  /* -------------------- FONCTION EST ADMIN() ------------------ */

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

      <!--/* Sa ces les 2 bouttons /a previous et /a next! -->
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
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

$p_requeteID = $bdd->prepare(
  'SELECT IDutilisateur
  FROM utilisateur
  WHERE Mail = :login
  AND MDP = :pw'
);
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

/*  Pour tester cette fonction:
$pw = 'hugolebg';
$login = 'hugolausenazpire@gmail.com';
if (GetIDUtilisateur($login, $pw)) {
  echo "GG WP";
}
else {
  echo "Perdu";
}*/
}
  /* -------------------- FONCTION GET UTILISATEUR() ------------------ */
function GetUtilisateur($id)
/**
*\author Hugo Lausenaz-Pire
*\verificator Joseph Tabailloux & Frederic Pinaud
*\brief renvoit un array avec toutes les info de l'utilisateur
* L'IDutilisateur, l'identifiant de l'utilisateur
*\Test Regarder à la fin de la fonction
*\return L'array avec toutes les infos: mdp, mail, nom, prenom etc...
*/
{
global  $bdd;
$p_requeteInfo = $bdd->query(
  'SELECT * FROM utilisateur WHERE IDutilisateur = ' . $id);

  while ($info = $p_requeteInfo->fetch()) {
    return $info;
  }
}
/* POUR TESTER LA FONTION
$info = GetUtilisateur(5);
var_dump($info);
 */
 /* -------------------- FONCTION VERIF LOGIN() ------------------ */
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

   $NewPassword = sha1($pw . DB_SALT . $mail);

     /* Je prépare ma requête SQL, je select le mail et le mdp de l'utilisateur */
     $p_seco = $bdd->prepare('SELECT Mail, MDP from utilisateur
       where  Mail =:mail and MDP =:mdp');

     /* Comme j'ai fait un prepare, je fait un execute avec les valeurs d'entrée */
     $p_seco->execute(array('mail' => $mail, 'mdp' => $NewPassword));
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
  /* -------------------- FONCTION IS LOGIN EXIST() ------------------ */
function isLoginExist($mail)
{
  /**
  *\author Hugo Lausenaz-Pire
  *\verificator Joseph Tabailloux & Frédéric Pinaud
  *\brief Vérifie si le mail existe déjà, elle est différente que le DAO
  * Prend en paramètre un mail
  *\return un vrai si le mail est déja utilisé, False si il ne l'est pas encore utilisé
  *\Test Regarder à la fin de la fonction
  */
  global $bdd; /* J'importe la base de donnée */

  $p_requeteMail = $bdd->prepare(
    'SELECT * FROM utilisateur WHERE Mail = :Mail');
    $p_requeteMail->execute(array(
      'Mail' => $mail
    ));
    if ($Exist = $p_requeteMail->fetch()) {
      return True;
    }
    else {
      return False;
    }
}
/*  POUR TESTER LA FONCTION CHANGER $mail
$mail = 'hugolausenazpire@gmail.com';

if (isLoginExist($mail)) {
  echo "Pas de chance le mail existe";
}
else {
  echo "GG Tu es original !";
}
*/

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
  /* POUR TESTER LA FONCTION
  echo afficheFormInscription();
  */

  /* -------------------- FONCTION CONTROLE FORM INSCRIPTION() ------------------ */
  function controleFormInscription($tab)
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
    if (strlen($tab['Nom'] <3)) {
      $_SESSION['msgErreur'] .= "Nom absent ou trop court <br>";
    }
    if (strlen($tab['Prenom'] <3)) {
      $_SESSION['msgErreur'] .= "Prénom absent ou trop court <br>";
    }
    if (!filter_var($tab['Mail'], FILTER_VALIDATE_EMAIL)) {
      $_SESSION['msgErreur'] .= "Mail invalide <br>";
    }
    if (strlen($tab['MDP'] < 7)) {
      $_SESSION['msgErreur'] .= "Mail absent ou trop court (8 caractères minimum) <br>";
    }
    if ($tab['MDP'] != $tab['confirmation']) {
      $_SESSION['msgErreur'] .= "Les deux mots de passse sont différents <br>";
    }
  }

  /* -------------------- FONCTION AJOUTE UTILISATEUR() ------------------ */
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
