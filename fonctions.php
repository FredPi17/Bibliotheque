 <?php
 /**
**\author Frederic Pinaud
*\Tout le monde peut vérifier
*\Ce fichier permet le regroupement de toutes les fonctions pour la bibliotheque
*\ -> la fonction Menu() permet d'afficher le menu du site
*\ -> la fonction piedPage() permet d'afficher le pied de page du site
*\ -> la fonction connexion() permet de se connecter à la base de données
*/

 function estAdmin()
  /**
  *\author Hugo Lausenaz-Pire
  *\verificator Joseph Tabailloux
  *\brief renvoit vrai si l'administrateur est connecté sinon renvoit faux
  * elle n'a pas de paramètres
  *\return vrai ou faux selon la condition.
  */
  {
    //Si l'admin de la session existe, il est connecté
    if (isset ($_SESSION['admin'])) {
    //Je renvois vrai
      return true;
    }
    //Sinon la session administrateur n'est pas ouverte
    else {
    //Je renvois faux
      return false;
    }
  }

  function estConnecte()
  /**
  *\author Hugo Lausenaz-Pire
  *\verificator Joseph Tabailloux
  *\brief renvoit vrai si l'utilisateur est connecté sinon renvoit faux
  * elle n'a pas de paramètres
  *\return ou faux selon la condition.
  */
  {
      //Si l'id de l'utilisateur existe, il est connecté
      if (isset($_SERVER['id']))
      {

        $_SERVER['id']= "ok";
       echo 'coucou'; //Je renvois vrai
      }

      //Si l'id n'existe pas, l'utilisateur n'est pas connecté
      else
      {
      //Je renvois faux
        return false;
      }
  }

 function Menu()
  {
    // Déclaration de ma variable menu string
    $menu = "";
     //Je concatène le début d'une liste à puce
    $menu .= '<ul class="nav nav-tabs">
                <li role="presentation" class="active"><a href="index.php">Accueil</a></li>
                <li role="presentation"><a href="livre.php">Liste</a></li>
                <li role="presentation"><a href="profil.php">Profil</a></li>
              </ul>
              <nav>';

    // Si la fonction estConnecte renvoie vrai alors:
    if (estConnecte())
    {
    // Comme l'utilisateur est connecté je concatene $menu avec une nouvelle puce "Profil"
      $menu .= '<li>
      <a href="ficheUtilisateur.php?id='. $_SESSION['id'] .'">Profil</a>
                </li>';

    }
    // Sinon l'utilisateur n'est pas connecté, je concatene $menu pour ajouter une puce "Se connecter"
    else {
      $menu .= '<li>
                  <a href="connexion.php">Se connecter</a>
                </li>';

    }

    // Je concatène $menu pour fermer la liste à puce et je ferme la balise nav
    $menu .= '</ul>
            </nav>';

     // Je renvoit $menu le menu donc.
    return $menu;
  }

  function piedPage()
  /**
  *\author Hugo Lausenaz-Pire
  *\verificator Joseph Tabailloux
  *\brief renvoie une valeur qui contient le bas de la page
  * elle n'a pas de paramaètres
  *\return un string $piedpage qu'il faudra afficher.
  */
  {
    // Création de $piedpage qui contient du texte et un lien hypertexte, possible de mettre des images
    $piedpage = '<footer>
                    <p>Site réalisé par les B1 EPSI Grenoble, 2016-2017,
                    <a href="#">CGU</a></p>
                </footer>
            </body>';

    //Je renvoit $piedpage (le bas de la page)
                return $piedpage;
  }
/*Connexion BDD*/
  function connexion(){
    define("DB_SERVER", "localhost");
    define("DB_BASE", "bibliotheque");
    define("DB_USER", "root");
    define("DB_PASSWORD", "");

    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_BASE, DB_USER, DB_PASSWORD, $pdo_options);
    $bdd->exec("Set character set utf8");
}

/*function estAdmin()
  /**
  *\author Hugo Lausenaz-Pire
  *\verificator Joseph Tabailloux
  *\brief renvoit vrai si l'administrateur est connecté sinon renvoit faux
  * elle n'a pas de paramètres
  *\Test pour tester la fonction regarder à partir de la ligne 21
  *\return vrai ou faux selon la condition.
  */
 /* {
    if (isset ($_SESSION['admin'])) {     // Si l'admin de la session existe il est connecté
      return true;                        // Je renvois vrais
    }
    else {                                // Sinon la session administrateur n'est pas ouverte
      return false;                       //Je renvois faux
    }
  }*/

/*function estConnecte()
  /**
  *\author Hugo Lausenaz-Pire
  *\verificator Joseph Tabailloux
  *\brief renvoit vrai si l'utilisateur est connecté sinon renvoit faux
  * elle n'a pas de paramètres
  *\test Pour tester regarder à partir de la ligne 24.
  *\return ou faux selon la condition.
  */
 /* {
      if (isset($_SESSION['id']))         //Si l'id de l'utilisateur existe, il est connecté
      {
        return true;                      //Je renvois vrai
      }
      else                                //Si l'id n'existe pas, l'utilisateur n'est pas connecté
      {
        return false;                     //Je renvois faux
      }
  }*/

/**
  *\author Loris Rabatel
  *\verificator Hugo Lausenaz-Pire
  *\Affichage de la liste des villes de la base
  *\test Pour tester regarder à partir de la ligne 24.
  *\return ou faux selon la condition.
  */
function listelivre(){
  include('connexionBDD.php');
try {
  echo '<h1>Listes des livres</h1>'."\n";/*le titre*/
  echo '<table>'."\n"; /*ouvre le tableau*/
  echo '<tr><th>Auteur</th><th>Titre</th><th>Image</th>' ."\n";/*nom des colonnes*/
  $reponse = $bdd->query('SELECT auteur.Nom, objet.Titre, objet.image from objet, auteur where auteur.IDauteur = objet.IDauteur');
  // On affiche chaque entrée une à une

  while ($donnees = $reponse->fetch()) {
    echo  '<tr><td>'. $donnees['Nom'] . '</td><td>' . $donnees['Titre'] . '</td><td>' . $donnees['image'] . '</td></tr>' . "\n" ;
  }
  $reponse->closeCursor(); // Termine le traitement de la requête
  echo '</table>';
} catch(Exception $e) {
  // En cas d'erreur précédemment, on affiche un message et on arrête tout
  die('Erreur : '.$e->getMessage());
}
}

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
