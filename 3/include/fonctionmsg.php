<?php
 
if (isset($_POST['valider'])) {
 
     if (empty($_POST['prenom'])) {
 
          $error = 'Vous n\'avez pas indiqué votre prénom.';
     }
 
     elseif (empty($_POST['pseudo'])) {
 
          $error = 'Veuillez choisir un pseudo.';
     }
 
     elseif (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
 
          $error = 'Veuillez saisir une adresse e-mail valide.';
     }
 
     // etc. avec tous les champs obligatoires
 
     else {
 
          // on considére que les données peuvent être enregistrées
          // on exécute la requête en prenant soit d'éviter toute injection avec mysql_real_escape_string()
     }
}
 
// si une erreur survient
if (isset($error)) {
 
     echo '<font color="red">'.$error.'</font>';
}
 
?>