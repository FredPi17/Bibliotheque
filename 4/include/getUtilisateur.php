<?php
/* -------------------- FONCTION GET ID UTILISATEUR() ------------------ */
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
global $bdd;
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
?>
