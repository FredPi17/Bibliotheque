<?php
session_start();
include("include/outils.php");
$date = date("Y-m-d");
$id = $_GET['code'];
if(isset($_GET['rendu']) && isset($_GET['livre'])){
  $ID = $_GET['livre'];
  $update=$bdd->query("UPDATE reservation SET dateRendu='$date',Emprunté=0, Rendu=1 WHERE IDobjet = $ID");

}
Header("Location:ficheutilisateur.php?id=$id");
die();

if (isset($_GET['mail']) && isset($_GET['id'])){

  $destinataire=$bdd->prepare('SELECT Mail, Nom, Prenom, datedébut, datefin, Titre FROM utilisateur, objet, reservation WHERE utilisateur.IDutilisateur = :ID AND utilisateur.IDutilisateur = reservation.IDutilisateur AND reservation.IDobjet = objet.IDobjet');
  $destinataire->execute(array(
    'ID' => $_GET['id']
  ));
  while($donnees = $destinataire->fetch()){
    $Mail = $donnnees['Mail'];
    $Nom = $donnees['Nom'];
    $Prenom = $donnees['Prenom'];
  }

  $mail = 'fpinaud17@gmail.com'; // Déclaration de l'adresse de destination.

  if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn|gmail).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.

  {

      $passage_ligne = "\r\n";

  }

  else

  {

      $passage_ligne = "\n";

  }

  //=====Déclaration des messages au format texte et au format HTML.

  $message_txt = "Bonjour $Nom $Prenom, ";

  $message_html = "<html><head></head><body>Je te contacte car tu as emprunté le livre $Titre le $datedébut et selon le contrat, tu dois le rendre avant le $datefin.</body></html>";

  //==========



  //=====Création de la boundary

  $boundary = "-----=".md5(rand());

  //==========



  //=====Définition du sujet.

  $sujet = "Hey mon ami !";

  //=========



  //=====Création du header de l'e-mail.

  $header = "From: \"WeaponsB\"<fpinaud17@gmail.com>".$passage_ligne;

  $header.= "Reply-to: \"WeaponsB\" <fpinaud17@gmail.com>".$passage_ligne;

  $header.= "MIME-Version: 1.0".$passage_ligne;

  $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

  //==========



  //=====Création du message.

  $message = $passage_ligne."--".$boundary.$passage_ligne;

  //=====Ajout du message au format texte.

  $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;

  $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;

  $message.= $passage_ligne.$message_txt.$passage_ligne;

  //==========

  $message.= $passage_ligne."--".$boundary.$passage_ligne;

  //=====Ajout du message au format HTML

  $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;

  $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;

  $message.= $passage_ligne.$message_html.$passage_ligne;

  //==========

  $message.= $passage_ligne."--".$boundary."--".$passage_ligne;

  $message.= $passage_ligne."--".$boundary."--".$passage_ligne;

  //==========



  //=====Envoi de l'e-mail.

  mail($mail,$sujet,$message,$header);

  //==========
}
Header("Location:ficheutilisateur.php?id=$id");
die();
?>
