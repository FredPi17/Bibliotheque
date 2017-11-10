<?php

if(!empty($_FILES['file'])) {
    if($_FILES['file']['error'] > 0) {
        exit('Erreur n°'.$_FILES['file']['error']);
    }
    if(is_uploaded_file($_FILES['file']['tmp_name'])) {
      $target = "image/". $_FILES['file']['name'];
        if(move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
            echo 'Fichier enregistré';
        } else {
            exit('Erreur lors de l\'enregistrement');
        }
    } else {
        exit('Fichier non uploadé');
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <h1>Test Upload Fichier</h1>
        <pre>
            <?php if(!empty($_FILES)){var_dump($_FILES);} ?>
        </pre>
        <form method="post" action="test.php" enctype="multipart/form-data">
            <label for="fileInput">Fichier:</label>
            <input id="fileInput" name="file" type="file" />
            <input type="submit" value="Envoyer"/>
        </form>
    </body>
</html>
