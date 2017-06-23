<?php
session_start();
include("include/outils.php");
include("include/utilisateur.php");
include("include/livre.php");

if (isset($_POST['inscription'])) {
  header('Location: inscription.php');
  die() ;
}
/*if (isset($_POST['connecter'])) {
  global $bdd;

  $NewPassword = sha1($_POST['mdp']) . DB_SALT . strtolower($_POST['login']);
  $p_requeteConnexion = $bdd->prepare('SELECT IDutilisateur, MDP, Mail, Nom, Prenom, Admin
                                          FROM utilisateur
                                          WHERE Mail = :mail and MDP = :pw');
  $p_requeteConnexion->execute(array(
    'mail' => $_POST['login'],
    'pw' => $NewPassword
  ));
  if ($id = $p_requeteConnexion->fetch())
  {
    if ($id['MDP'] == sha1($_POST['mdp'] . DB_SALT . strtolower($_POST['login']))) {
      session_start();
      $_SESSION['id'] = $id['IDutilisateur'];
      $_SESSION['mail'] = $id['Mail'];
      $_SESSION['mdp'] = $id['MDP'];
      $_SESSION['nom'] = $id['Nom'];
      $_SESSION['prenom'] = $id['Prenom'];
      $_SESSION['admin'] = $id['Admin'];
      header('Location: index.php');
      die() ;
    }
  }
  else {
    echo "<br>Erreur test";
  }
}*/
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="initial-scale=1, user-scalabe=yes"/>
  <meta charset="utf-8" />
  <title>Connexion</title>
  <meta name="generator" content="Bootply" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link href="style/css/bootstrap.min.css" rel="stylesheet">
  <link href="style/css/styles.css" rel="stylesheet">
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
  <!--[if lt IE 9]>
  <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <link href="css/styles.css" rel="stylesheet">

</head>
<body>

<?php echo menuConnexion(); ?>
<!--  <div class="container-full">
    <div class="row">
      <div class="col-lg-12 text-center v-center">
        <h1>Se Connecter</h1>
          <br><br><br>
          <form method="post" class="col-lg-12">

              <div class="input-group" style="width:340px;text-align:center;margin:0 auto;">

                <label for="login">E-mail
                  <input type="text" name="login" id="login" class="form-control">
                </br>
                </label>

                <label for="mdp">Mot de passe
                  <input type="password" name="mdp" id="mdp" class="form-control"></br>
                </label>

                <span class="input-control input-lg">
                  <input type="submit" class="btn btn-lg btn-primary" name="connecter" value="Se connecter" id="Submit_connexion">
                </span>

                <span class="input-control input-lg">
                  <input type="submit" class="btn btn-lg btn-primary" name="retour" value="Retour" id="Submit_retour">
                </span>

              </div>
          </form>
        </div>
      </div>
    </div>-->
</body>
</html>
