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

  $NewPassword = sha1($tab['mdp'] . DB_SALT . strtolower($tab['mail']));

  $p_requeteInsert = $bdd->prepare( 'INSERT INTO utilisateur (MDP, Mail, Nom, Prenom, Admin)
    VALUES ( :mdp, :Mail, :nom, :prenom, :admin  )'
  );
    $p_requeteInsert->execute(array(
      'Mail' => $tab['mail'],
      'mdp' => $NewPassword,
      'prenom' => $tab['prenom'],
      'nom' => $tab['nom'],
      'admin' => False
    ));
    $ID = $bdd->lastInsertId();
    return $ID;
}
