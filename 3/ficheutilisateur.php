<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bibliotheque | Accueil</title>
  <!-- Bootstrap -->
    <link href="style/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <link href="style/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="style/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <!-- /**Le jquery ne se trouve pas dans le download boot strap on est obligé de le récupérer enligne!*/-->
  <script src="js/bootstrap.min.js"></script>
  <style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 70%; /**Règle ta taille de carrousel /a width*/
      margin: auto;
  }
  </style>
</head>
<?php
session_start();
include("include/outils.php");
include("include/utilisateur.php");
echo menuConnexion();
echo Menu();
if (isset($_GET["code"])) {
  $p_requete = $bdd->prepare('select nom, prenom, mail, IDutilisateur from utilisateur where utilisateur.IDutilisateur = :code ');
  $p_requete -> execute(array('code'=> $_GET["code"]));
    if ($donnees = $p_requete->fetch()){
      echo '<title>Fiche de ' . $donnees['prenom'] . ' </title>
      	<h1>Fiche de ' .  $donnees['prenom'] .' </h1><br>';

        echo '<form method="get">';
        echo '<table>';
        echo '<tr>';
        echo '<td><label for="nom">Nom :</label></td>';
        echo '<td><input type="text" name="nom" id="nom" value="' . $donnees['nom'] .'"></td>';
        echo "</tr>\n";

        echo '<tr>';
        echo '<td><label for="nom">Prenom :</label></td>';
        echo '<td><input type="text" name="prenom" id="prenom" value="' . $donnees['prenom'] .'"></td>';
        echo "</tr>\n";

        echo '<tr>';
        echo '<td><label for="nom">Email :</label></td>';
        echo '<td><input type="text" name="mail" id="mail" value="' . $donnees['mail'] .'"></td>';
        echo "</tr>\n";

      echo '<tr>';
      echo '<td></td>';
      echo '<td><input type="submit" name="modifier" value="modifier">';
      echo '<input type="submit" name="supprimer" value="supprimer"></td>';
      echo '</tr>';

      echo '<input type="hidden" name="code" value="' . $_GET["code"].'">';

      echo '</table>';
      echo '</form>';

    }
    else
      die("Eh, le Noob pas de blague");
}

if(isset($_GET['retour'])){
  header('Location: listeutilisateur.php');
  die();
}

if (isset($_GET['nouveau'])){
    echo '<title>Nouvel utilisateur</title>
      <h1>Nouvel utilisateur</h1><br>';
  $donnees['nom'] = '';
  $donnees['prenom'] = '';
  $donnees['mail'] = '';
  $donnees['mdp'] = '';
  $donnees['conf-mdp'] = '';
  $donnees['admin']  = 0;

  echo afficheFormNouveau();

}

if (isset($_GET['supprimer'])){
	$p_requete = $bdd->prepare('DELETE from utilisateur where utilisateur.IDutilisateur = :utilisateur');
	$p_requete -> execute(array('utilisateur' => $_GET['code']));

	/*$p_requete3 = $bdd->prepare('DELETE from note where note.IDobjet = :objet');
	$p_requete3 -> execute(array('objet' => $_GET['IDobjet']));

	$p_requete4 = $bdd->prepare('DELETE from reservation where reservation.IDobjet = :objet');
	$p_requete4 -> execute(array('objet' => $_GET['IDobjet']));

  $p_requete = $bdd->prepare('DELETE from objet where objet.IDobjet = :objet');
  $p_requete -> execute(array('objet' => $_GET['IDobjet']));*/

  header('Location: listeutilisateur.php?msg=Suppression bien effectuée !');
  die();
}
if (isset($_GET['contacter'])){
    $to = 'fpinaud17@gmail.com';
     $subject = 'test mail';
     $message = 'Bonjour !';
    /* $headers = 'From: fpinaud17@gmail.com' . "\r\n" .
     'Reply-To: fpinaud17@gmail.com' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();*/

   mail($to, $subject, $message);
}
if (isset($_GET['sendMail'])){
  $to = 'fpinaud17@gmail.com';
  $body = 'Voici le contenu du mail';
  $subject = 'Test envoi mail';
  ?>
  <a href="mailto:<?php echo $to; ?>?body=<?php echo $body; ?>?subject=<?php echo $subject; ?>"></a>
  <?php
}
if (estAdmin()){
?>
<form method="get" action="nouvelUtilisateur.php">
  <table>
    <tr>
      <th>Nom</th>
      <th>Prenom</th>
    </tr>
    <?php
   global $bdd;
    $p_reponse = $bdd->query('select nom, prenom, IDutilisateur from utilisateur');
      while ($donnees = $p_reponse->fetch()){
        ?>
    <tr>
      <td><a href="ficheutilisateur.php?code=<?php echo $donnees['IDutilisateur'];  ?> "> <?php echo $donnees['nom'];?> </a>
      <td><a href="ficheutilisateur.php?code=<?php echo $donnees['IDutilisateur'];  ?> "> <?php echo $donnees['prenom'];?> </a>
    </tr>
      <?php } ?>
    <tr>
      <td></td><td><input type="submit" name="nouveau" value="Nouveau"></td>
    </tr>
    </table>
  </form>
  <form method="get" action="nouveauLivre.php">
    <table>
      <tr>
        <th>Auteur</th>
        <th>Titre</th>
        <th>Image</th>
      </tr>
      <?php
      $reponse = $bdd->query('SELECT objet.IDobjet as IDobjet, auteur.Nom, objet.Titre, objet.image from objet, auteur where auteur.IDauteur = objet.IDauteur');
      while ($donnees = $reponse->fetch()) {
        ?>
          <tr>
            <td><?php echo $donnees['Nom']; ?></td>
            <td><a href="fichelivre.php?IDobjet= <?php echo $donnees['IDobjet']; ?> "> <?php echo $donnees['Titre']; ?></a></td>
            <td><?php echo $donnees['image']; ?></td>
          </tr>
          <?php
        } ?>
        <tr><td></td><td><input type="submit" name="nouveau" value="Nouveau"></td>
        </tr>
      </table>
    </form>
    <form method="get" >
      <table>
        <tr>
          <th>Nom du livre</th>
          <th>Emprunté par</th>
          <th>Date début</th>
          <th>Date fin </th>
          <th>Contact</th>
        </tr>
        <?php
        $reponse2 = $bdd->query('SELECT objet.Titre as Titre, utilisateur.nom as Nom, reservation.Datedébut as Datedébut, reservation.Datefin as Datefin from reservation, objet, utilisateur where reservation.IDobjet = objet.IDobjet and reservation.IDutilisateur = utilisateur.IDutilisateur');
        while ($donnees2 = $reponse2->fetch()){
          ?>
          <tr>
            <td><?php echo $donnees2['Titre'];?></td>
            <td><?php echo $donnees2['Nom'];?></td>
            <td><?php echo $donnees2['Datedébut'];?></td>
            <td><?php echo $donnees2['Datefin'];?></td>
            <td><input type="submit" name="contacter" value="Contacter"></td>
            <td><input type="submit" name="sendMail" value="sendMail"></td>
          </tr>

      <?php  } ?>
        <table>
      </form>
<?php
}

if (estConnecte()){

}
 ?>
