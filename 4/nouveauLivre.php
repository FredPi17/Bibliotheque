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
  <style>
div{
  text-align: center;
}
  </style>
</head>
<?php
session_start();
include("include/outils.php");
include("include/utilisateur.php");
echo menuConnexion();
echo Menu();
if (estAdmin()) {
  echo'<div>
  <h1>Nouveau livre</h1>
  <form method="post" enctype="multipart/form-data">
    <label for="isbn">ISBN</label>
      <input type="text" name="isbn" id="isbn"><br />
    <label for="titre">Titre</label>
      <input type="text" name="titre" id="titre"><br />
    <label for="resume">Résumé</label>
      <input type="text" name="resume" id="resume"><br />
    <label for="auteur">Auteur</label>
      <input type="text" name="auteur" id="auteur"><br />
    <label for="categorie">Catégorie</label>
      <input type="text" name="categorie" id="categorie"><br />
    <label for="icone">Couverture du livre</label>
      <input type="file" name="icone" id="icone" /><br />
    <input type="submit" name="envoyer" value="envoyer">
  </form>
  </div>';
}
if(!estAdmin()) {
  echo "<div>Vous n'êtes pas autorisé d'accéder à cette page </div>";
}
?>

<?php
if (isset($_POST['envoyer'])){
  // TO DO !
  $target_dir = "image/";
   $target_file = $target_dir . basename($_FILES["icone"]["name"]); // target_file a upload sur BDD
   $uploadOk = 1;
   $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
   $photo = $target_file;
   if (move_uploaded_file($_FILES["icone"]["tmp_name"], $target_file)) {
         echo "L'image ". basename( $_FILES["icone"]["name"]). " a été correctement envoyée.";
     } else {
         echo "Désolé, nous rencontrons quelques problème sur l'envoie de l'image veuillez recommencer.";
     }
$upload = true;
if(strlen($_POST['titre']) <3)
{
  echo"Vous n'avez pas rentré de titre";
  $upload = false;
}
if(strlen($_POST['auteur']) <3)
{
  echo"Vous n'avez pas rentré d'auteur";
  $upload = false;
}

if(strlen($_POST['resume']) <3)
{
  echo"Vous n'avez pas rentré de résumé";
  $upload = false;
}
if(strlen($_POST['categorie']) <3)
{
  echo"Vous n'avez pas rentré de catgéorie";
  $upload = false;
}
if(strlen($_POST['isbn']) != 10)
{
  echo"Vous n'avez pas rentré d'isbn";
  $upload = false;
}
if ($upload) {
  global $bdd;
  $p_requeteSelectAuthors = $bdd->query('SELECT * FROM auteur');
  while($ListAuthor = $p_requeteSelectAuthors->fetch()){
    if ($ListAuthor["Nom"] == $_POST['auteur']) {
      $Author = $_POST['auteur'];
      $idAuthor = $ListAuthor["IDauteur"];
      $uploadAuthor = false;
    }
    else {
      $uploadAuthor = true;
    }
  }

  $p_requeteSelectBook = $bdd->query('SELECT ISBN from objet');
  while ($ListISBN = $p_requeteSelectBook->fetch()) {
    if($ListISBN["ISBN"] == $_POST['isbn'])
    {
      $uploadBook = false;
    }
    else {
      $uploadBook = True;
    }
  }

  $p_requeteSelectCat = $bdd->query('SELECT * from categories');
  while ($ListCat = $p_requeteSelectCat->fetch()) {
    if ($ListCat["Libelle"] == $_POST["categorie"]) {
      $uploadCat = false;
      $Libelle = $_POST['categorie'];
      $IDcategorie = $ListAuthor["IDcategorie"];
    }
    else {
      $uploadCat = true;
    }
  }


  if($uploadAuthor) {
    $Author = $_POST['auteur'];
    $p_requeteAddAuthor = $bdd->prepare('INSERT INTO auteur (Nom) VALUES (:nom)');
    $idAuthor = $bdd->lastInsertId();
    echo $idAuthor;
    $p_requeteAddAuthor->execute(array(
       'nom' => $_POST['auteur']
     ));
  }
  if ($uploadBook) {
    $p_requeteAddBook = $bdd->prepare('INSERT INTO objet (image, Resume, Titre, ISBN, IDauteur ) VALUES (:img, :resume, :titre, :isbn, :IDauteur)');
    $p_requeteAddBook->execute(array(
      'IDauteur' => $idAuthor,
      'img' => basename($_FILES['icone']['name']),
      'isbn' => $_POST['isbn'],
      'titre' => $_POST['titre'],
      'resume' => $_POST['resume']
    ));
    $idObjet = $bdd->lastInsertId();
    echo ($idObjet);
  }
  if ($uploadCat) {
    $p_requeteAddCat = $bdd->prepare('INSERT INTO categories (Libelle) VALUES (:libelle)');
    $p_requeteAddCat->execute(array(
      'libelle' => $_POST['categorie']
    ));
    $IDcategorie = $bdd->lastInsertId();
    echo ($IDcategorie);
  }

  $p_requeteAddAppartient = $bdd->prepare("INSERT INTO appartient (IDobjet, IDcategorie) VALUES (:IDobjet, :IDcategorie)");
  $p_requeteAddAppartient->execute(array(
    'IDobjet' => $idObjet,
    'IDcategorie' => $IDcategorie
  ));
}


}
?>
