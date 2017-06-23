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
  <link rel="stylesheet" href="style/css/ficheutilisateur.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <!-- /**Le jquery ne se trouve pas dans le download boot strap on est obligé de le récupérer enligne!*/-->
  <script src="js/bootstrap.min.js"></script>

</head>
<style>
  #part1, #part2{
    display: inline-block;
  }
  #fiche{
    border: 1px solid black;
  }
</style>
<?php
session_start();
include("include/outils.php");
include("include/utilisateur.php");
echo menuConnexion();
echo Menu();
if (isset($_GET['code'])) {
  $p_requete = $bdd->prepare('select image, nom, prenom, mail, IDutilisateur from utilisateur where utilisateur.IDutilisateur = :code ');
  $p_requete -> execute(array('code'=> $_GET['code']));
    if ($donnees = $p_requete->fetch()){
      ?>
      <form method="get">
      <table id="user">
        <h1>Fiche de <?php echo $donnees['prenom']; ?> </h1>
        <div id="tab">
        <tr>
          <th>Photo</th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Adresse mail</th>
        </tr>
        <tr>
          <td><img src="<?php echo $donnees['image'];?>"style="width:100px;height:100px;"><p><input type="file" name="fileToUpload" id="fileToUpload"></p></td>
          <td><label for="nom"></label><input type="text" name="nom" id="nom" value="<?php echo $donnees['nom'];?>"></td>
          <td><label for="prenom"><input type="text" name="prenom" id="prenom" value="<?php echo $donnees['prenom'];?>"></td>
          <td><label for="mail"><input type="email" name="mail" id="mail" value="<?php echo $donnees['mail'];?>"></td>
        </tr>
        <tr>
          <td colspan="4" >
            <input type="submit" name="modifier" value="modifier">
            <input type="submit" name="supprimer" value="supprimer">
            <input type="hidden" name="code" value="<?php echo $_GET["code"]; ?>">
          </td>
        </tr>
      </div>
    </table>
  </form>
    <?php
    }
    else
      die("Eh, le Noob pas de blague");
}

if(isset($_GET['retour'])){
  header('Location: listeutilisateur.php');
  die();
}

if (isset($_GET['supprimer'])){
  	$p_requete3 = $bdd->prepare('DELETE from note where note.IDutilisateur = :objet');
  	$p_requete3 -> execute(array('objet' => $_GET['code']));

  	$p_requete4 = $bdd->prepare('DELETE from reservation where reservation.IDutilisateur = :objet');
  	$p_requete4 -> execute(array('objet' => $_GET['code']));

  	$p_requete = $bdd->prepare('DELETE from utilisateur where utilisateur.IDutilisateur = :utilisateur');
  	$p_requete -> execute(array('utilisateur' => $_GET['code']));
    $id = $_SESSION['code'];
  header("Location: ficheutilisateur.php?id=$id");
  die();
}

if (isset($_GET['modifier'])){
  $target_dir = "images/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  $photo = $target_file;
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
  $p_requete = $bdd->prepare('UPDATE utilisateur SET nom = :nom, prenom = :prenom, mail = :mail, image = :image where utilisateur.IDutilisateur = :utilisateur');
  $p_requete -> execute(array(
    'image' => $target_file,
    'nom' => $_GET['nom'],
    'prenom' => $_GET['prenom'],
    'mail' => $_GET['mail'],
    'utilisateur' => $_GET['code']));
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
/*if (isset($_GET['sendMail'])){
  $to = 'fpinaud17@gmail.com';
  $email_message = 'Voici le contenu du mail';
  $email_subject = 'Test envoi mail';*/
//header( 'mailto:'.$to.  '?subject='.urlencode($email_subject).'&body='.urlencode($email_message));
//echo '<a href="mailto:'.$to.'?subject='.urlencode($email_subject).'&body='.urlencode($email_message).'">loul</a>';}


if (estConnecte()){
   global $bdd;
   ?>
   <article>
     <form>
  <table id="user">
    <h3>Moi</h3>
    <div id="tab">
    <tr>
      <th>Photo</th>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Adresse mail</th>
    </tr>
    <?php
    $id = $_GET['id'];
    if(!isset($_GET['modify'])){
      $p_requete3 = $bdd->prepare('select image, nom, prenom, mail from utilisateur where utilisateur.IDutilisateur = :code ');
      $p_requete3 -> execute(array('code'=> $_GET['id']));
        if ($donnees3 = $p_requete3->fetch()){
        ?>
        <tr>
          <td><img src="<?php echo $donnees3['image'];?>"style="width:100px;height:100px;"></td>
          <td><?php echo $donnees3['nom'];?></td>
          <td><?php echo $donnees3['prenom'];?></td>
          <td><?php echo $donnees3['mail'];?></td>
        </tr>
        <tr>
          <td colspan="4"><input type="hidden" name="id" value=<?php echo $id; ?>><input type="submit" name="modify" value="Modifier"></td>
        </tr>
        <?php
      }}
      if(isset($_GET['modify'])){
        $p_requete3 = $bdd->prepare('select image, nom, prenom, mail from utilisateur where utilisateur.IDutilisateur = :code ');
        $p_requete3 -> execute(array('code'=> $_GET['id']));
          if ($donnees3 = $p_requete3->fetch()){
          ?>
          <tr>
            <td><img src="<?php echo $donnees3['image'];?>"style="width:100px;height:100px;"></td>
            <td><input type="text" name="nom" value="<?php echo $donnees3['nom'];?>"></td>
            <td><input type="text" name="prenom" value="<?php echo $donnees3['prenom'];?>"></td>
            <td><input type="mail" name="mail" value="<?php echo $donnees3['mail'];?>"></td>
          </tr>
          <tr>
            <td colspan="4"><input type="submit" name="modifier" value="Valider"></td>
          </tr>
          <?php
        }}
       ?>
    </div>
</table>
</form>
</article>
<article>
  <form method="get" >
    <table id="res">
      <h3>Mes livres réservés</h3>
      <tr>
        <th>Nom du livre</th>
        <th>Emprunté par</th>
        <th>Date début</th>
        <th>Date fin </th>
        <th>Contact</th>
      </tr>
      <?php
      $id = $_SESSION['code'];
      $reponse2 = $bdd->query('SELECT objet.Titre as Titre, reservation.Datedébut as Datedébut, reservation.Datefin as Datefin from reservation, objet, utilisateur where reservation.IDobjet = objet.IDobjet and reservation.IDutilisateur = ' . $id .' ');
      while ($donnees2 = $reponse2->fetch()){
        ?>
        <tr>
          <td><?php echo $donnees2['Titre'];?></td>
          <td><?php echo $donnees2['Nom'];?></td>
          <td><?php echo $donnees2['Datedébut'];?></td>
          <td><?php echo $donnees2['Datefin'];?></td>
        </tr>

    <?php  } ?>
  </table>
    </form>
  </article>
<?php
}
if (estAdmin()){
?>
<article>
<form method="post" action="nouvelUtilisateur.php">
  <table id="user">
    <h3>Listes des utilisateurs</h3>
    <div id="tab">
    <tr>
      <th>Nom</th>
      <th>Prenom</th>
    </tr>
    <?php
   global $bdd;
   $id = $_SESSION['code'];
    $p_reponse = $bdd->query('select nom, prenom, IDutilisateur from utilisateur');
      while ($donnees = $p_reponse->fetch()){
        ?>
    <tr>
      <td><a href="ficheutilisateur.php?id=<?php echo $id;?>&code=<?php echo $donnees['IDutilisateur'];?>"> <?php echo $donnees['nom'];?> </a></td>
      <td><a href="ficheutilisateur.php?id=<?php echo $id;?>&code=<?php echo $donnees['IDutilisateur'];?>"> <?php echo $donnees['prenom'];?> </a></td>
    </tr>
      <?php } ?>
    <tr>
      <td colspan="2"><input type="hidden" name="id="<?php $_GET['id'];?>><input type="submit" name="nouveauU" value="Nouveau"></td>
    </tr>
  </div>
    </table>
  </form>
</article>

<article>
  <form method="get" action="nouveauLivre.php">
    <table id="livres">
      <h3>Listes des livres</h3>
      <tr>
        <th>Image</th>
        <th>Auteur</th>
        <th>Titre</th>

      </tr>
      <?php
      $reponse = $bdd->query('SELECT image, objet.IDobjet as IDobjet, auteur.Nom, objet.Titre, objet.image from objet, auteur where auteur.IDauteur = objet.IDauteur');
      while ($donnees = $reponse->fetch()) {
        ?>
          <tr>
            <td><img src="<?php echo $donnees['image'];?>"style="width:100px;height:150px;"></td>
            <td><?php echo $donnees['Nom']; ?></td>
            <td><a href="fichelivre.php?IDobjet= <?php echo $donnees['IDobjet']; ?> "> <?php echo $donnees['Titre']; ?></a></td>
          </tr>
          <?php
        } ?>
        <tr><td colspan="3"><input type="submit" name="nouveauL" value="Nouveau"></td>
        </tr>
      </table>
    </form>
  </article>
  <article>
    <form method="get" >
      <table id="res">
        <h3>Liste livres réservés</h3>
        <tr>
          <th>Nom du livre</th>
          <th>Emprunté par</th>
          <th>Date début</th>
          <th>Date fin </th>
          <th>Contact</th>
        </tr>
        <?php
        $reponse2 = $bdd->query('SELECT objet.Titre as Titre, utilisateur.Nom as Nom, reservation.Datedébut as Datedébut, reservation.Datefin as Datefin from reservation, objet, utilisateur where reservation.IDobjet = objet.IDobjet and reservation.IDutilisateur = utilisateur.IDutilisateur');
        while ($donnees2 = $reponse2->fetch()){
          ?>
          <tr>
            <td><?php echo $donnees2['Titre'];?></td>
            <td><?php echo $donnees2['Nom'];?></td>
            <td><?php echo $donnees2['Datedébut'];?></td>
            <td><?php echo $donnees2['Datefin'];?></td>
            <td><input type="submit" name="contacter" value="Contacter">
            <a href="mailto:fpinaud17@gmail.com?subject=Test&body=Hello%20World"><input type="button"name="" value="sendMail"></a></td>
          </tr>

      <?php  } ?>
    </table>
      </form>
    </article>
<?php
}

echo piedPage();

?>
