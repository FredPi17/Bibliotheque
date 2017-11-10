<?php
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
?>
