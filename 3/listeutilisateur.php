<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Liste utilisateurs</title>
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

</head>
<?php
session_start();
include("include/outils.php");
include("include/utilisateur.php");
echo Menu();
 ?>
<form method="get" action="ficheutilisateur.php">
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
      <td></td><td><input type="submit" name="nouveau" value="Nouveau"></td>;
    </tr>
    </table>
  </form>
</body>
</html>
