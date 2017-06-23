<?php
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
  ?>
