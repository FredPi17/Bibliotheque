<?php
/* -------------------- FONCTION CONTROLE FORM INSCRIPT ------------------ */
function controleFormInscription($tab)
/**
*\author Hugo Lausenaz-Pire
*\verificator Joseph Tabailloux
*\brief affecte une valeur à un formulaire de connexion avec un titre h1
* Pas de paramètre
*\return return le formulaire sous forme de string
*\Test Regarder à la fin de la fonction
*/
{
  session_start();
  if (strlen($tab['Nom'] <3)) {
    $_SESSION['msgErreur'] .= "Nom absent ou trop court <br>";
  }
  if (strlen($tab['Prenom'] <3)) {
    $_SESSION['msgErreur'] .= "Prénom absent ou trop court <br>";
  }
  if (!filter_var($tab['Mail'], FILTER_VALIDATE_EMAIL)) {
    $_SESSION['msgErreur'] .= "Mail invalide <br>";
  }
  if (strlen($tab['MDP'] < 7)) {
    $_SESSION['msgErreur'] .= "Mail absent ou trop court (8 caractères minimum) <br>";
  }
  if ($tab['MDP'] != $tab['confirmation']) {
    $_SESSION['msgErreur'] .= "Les deux mots de passse sont différents <br>";
  }
}
/* -------------------- FONCTION AJOUTE UTILISATEUR() ------------------ */
function ajouteUtilisateur($tab)
{
  /**
  *\author Hugo Lausenaz-Pire
  *\verificator Joseph Tabailloux
  *\brief C'est un requete INSERT
  * Tableau du post inscription
  *\return l'identifiant de l'utilisateur
  *\Test Regarder le inscription.php
  */
  global $bdd;

  $NewPasseword = sha1($tab['MDP'] . DB_SALT . strlower($tab['Mail']));

  $p_requeteInsert = $bdd->prepare( 'INSERT INTO utilisateur (MDP, Mail, Nom, Prenom, Admin)
    VALUES ( :mdp, :mail, :nom, :prenom, :admin  )'
  );
    $p_requeteInsert->execute(array(
      'Mail' => $tab['Mail'],
      'mdp' => $NewPasseword,
      'prenom' => $tab['prenom'],
      'nom' => $tab['nom'],
      'Admin' => False,
    ));
    $ID = $p_requeteInsert->lastInsertId();
    return $ID;
}
