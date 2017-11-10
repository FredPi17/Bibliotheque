<?php

	/* -------------------- CONNEXION A LA BASE DE DONNEES ------------------ */

	define("DB_SERVER", "localhost");
	define("DB_BASE", "bibliotheque");
	define("DB_USER", "root");
	define("DB_PASSWORD", "");
	define('DB_SALT', 'Les5G'); // C'est le grain de sel

	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_BASE, DB_USER, DB_PASSWORD, $pdo_options);
	$bdd->exec("Set character set utf8");

			/* -------------------- FONCTION MENU() ------------------ */

  function Menu()

  {
    $menu = "";/* Déclaration de ma variable menu string  */

		$menu .= '<div id="logo">
							<img src="image/logo.png"width="60%">
							</div>';
    $menu .= '<nav id="nav">
                <ul>
                  <li><a href ="index.php">Accueil</a></li>
                  <li><a href ="listelivre.php">Livres</a></li>';
    if (estConnecte())
		{          /* Je concatène le début d'une liste à puce */
		    if (!estAdmin()) /* Si la fonction estAdmin n'est pas vraie alors: */
		    {
		      $menu .= '<li><a href="ficheutilisateur.php?id='. $_SESSION['code'] .'">Profil</a></li>';
		                /* Comme l'utilisateur est connecté je concatene $menu avec une nouvelle puce "Profil" */
		    }
				 if (estAdmin()) /* Si la fonction estAdmin renvoie vrai alors: */
				{
					$menu .= '<li><a href="ficheutilisateur.php?id='. $_SESSION['code'] .'">Administrateur</a></li>';
										/* Comme l'utilisateur est connecté je concatene $menu avec une nouvelle puce "Administrateur" */
				}
		}
      $menu .='<li><a href="about.php">A propos</a></li></ul></nav>';
    /* Je concatène $menu pour fermer la liste à puce et je ferme la balise nav */
    return $menu; /* Je renvoit $menu le menu donc. */
  }

	/* -------------------- FONCTION PIED PAGE() ------------------ */

	function piedPage()
	{
		if (estConnecte()){
			if (!estAdmin()) /* Si la fonction estAdmin n'est pas vraie alors: */
			{
			$piedPage = '<footer> <div class="bot"><li><a href="index.php">Accueil - </a></li><li><a href="listelivre.php"> Liste - </a></li><li><a href="about.php"> A propos - </a></li><li><a href="ficheutilisateur.php?id='. $_SESSION['code'] . '"> Profil</a></li></div> <p> Site réalisé par les B1 EPSI Grenoble, 2016-2017 <a href="#"CGU</a></p><div class="bot"><li><a href="http://www.epsi.fr/Campus/Campus-de-Grenoble"> EPSI - </a></li><li><a href="http://www.ecoles-idrac.com/Idrac/Campus-de-Grenoble"> IDRAC - </a></li><li><a href="http://www.ecoles-supdecom.com/campus/grenoble/"> SupDeCom</a></li></div>
			</footer>
			</body></html>';
		}}
		if (estConnecte()){
			if (estAdmin()) /* Si la fonction estAdmin renvoie vrai alors: */
		 {
			$piedPage = '<footer> <div class="bot"><li><a href="index.php">Accueil - </a></li><li><a href="listelivre.php"> Liste - </a></li><li><a href="about.php"> A propos - </a></li><li><a href="ficheutilisateur.php?id='. $_SESSION['code'] . '"> Admin</a></li></div> <p> Site réalisé par les B1 EPSI Grenoble, 2016-2017 <a href="#"CGU</a></p><div class="bot"><li><a href="http://www.epsi.fr/Campus/Campus-de-Grenoble"> EPSI - </a></li><li><a href="http://www.ecoles-idrac.com/Idrac/Campus-de-Grenoble"> IDRAC - </a></li><li><a href="http://www.ecoles-supdecom.com/campus/grenoble/"> SupDeCom</a></li></div>
			</footer>
			</body></html>';
		}}
		else {
			$piedPage = '<footer> <div class="bot"><li><a href="index.php">Accueil - </a></li><li><a href="listelivre.php"> Liste - </a></li><li><a href="about.php"> A propos</a></li></div> <p> Site réalisé par les B1 EPSI Grenoble, 2016-2017 <a href="#"CGU</a></p><div class="bot"><li><a href="http://www.epsi.fr/Campus/Campus-de-Grenoble"> EPSI - </a></li><li><a href="http://www.ecoles-idrac.com/Idrac/Campus-de-Grenoble"> IDRAC - </a></li><li><a href="http://www.ecoles-supdecom.com/campus/grenoble/"> SupDeCom</a></li></div>
			</footer>
			</body></html>';
		}
		return $piedPage;
								/* Création de $piedpage qui contient du texte
								* et un lien hypertexte, possible de mettre des images */
	}

			/* -------------------- "FONCTION" INDEX() ------------------ */
function Index()
{
				/*Importation de la fonction Menu*/
				$echo = Menu();
				$echo .= Carrousel();
				/*if (estConnecte()) {
					$echo .= $liste = getFavori($_SESSION['code'], Taille_Carrousel) ;
				}
				else {
					$liste = getRandom(3);
				}*/
				//$echo .= carrousel($liste);


				return $echo;

}

function supprimer(){
	global $bdd;
	$p_requete3 = $bdd->prepare('DELETE from note where note.IDutilisateur = :objet');
	$p_requete3 -> execute(array('objet' => $_GET['code']));

	$p_requete4 = $bdd->prepare('DELETE from reservation where reservation.IDutilisateur = :objet');
	$p_requete4 -> execute(array('objet' => $_GET['code']));

	$p_requete = $bdd->prepare('DELETE from utilisateur where utilisateur.IDutilisateur = :utilisateur');
	$p_requete -> execute(array('utilisateur' => $_GET['code']));
	$id = $_SESSION['code'];
	header("Location: ficheutilisateur.php?id=$id");
	die();

}

function modifier(){
	global $bdd;
	if(!empty($_FILES["file"])) {
	    if($_FILES["file"]["error"] > 0) {
	        exit('Erreur n°'.$_FILES["file"]["error"]);
	    }
	    if(is_uploaded_file($_FILES["file"]["tmp_name"])) {
	      $target = "image/". $_FILES["file"]["name"];
	        if(move_uploaded_file($_FILES["file"]["tmp_name"], $target)) {
	            echo 'Fichier enregistré';
	        } else {
	            exit('Erreur lors de l\'enregistrement');
	        }
	    } else {
	        exit('Fichier non uploadé');
	    }
	}
	else{
		echo 'Aucune image uploadée';
	}
  $p_requete = $bdd->prepare('UPDATE utilisateur SET nom = :nom, prenom = :prenom, mail = :mail, image = :image where utilisateur.IDutilisateur = :utilisateur');
  $p_requete -> execute(array(
    'image' => $target,
    'nom' => $_POST['nom'],
    'prenom' => $_POST['prenom'],
    'mail' => $_POST['mail'],
    'utilisateur' => $_POST['code']));
}

function profil(){
	global $bdd;?>
	<div class="row small-up-1 medium-up-1 large-up-1">
		<div class="column">
			<form>
			 <table id="user">
				 <h3>Moi</h3>
				 <div id="tab">
				 <tr>
					 <th>Photo</th>
					 <th>Nom</th>
					 <th>Prénom</th>
					 <th>Adresse mail</th>
				 </tr>
				 <?php
				 $id = $_GET['id'];
				 if(!isset($_GET['modify'])){
					 $p_requete3 = $bdd->prepare('select image, nom, prenom, mail from utilisateur where utilisateur.IDutilisateur = :code ');
					 $p_requete3 -> execute(array('code'=> $_GET['id']));
						 if ($donnees3 = $p_requete3->fetch()){
						 ?>
						 <tr>
							 <td><img src="<?php echo $donnees3['image'];?>"style="width:100px;height:100px;"></td>
							 <td><?php echo $donnees3['nom'];?></td>
							 <td><?php echo $donnees3['prenom'];?></td>
							 <td><?php echo $donnees3['mail'];?></td>
						 </tr>
						 <tr>
							 <td colspan="4"><input type="hidden" name="id" value=<?php echo $id; ?>><input type="submit" name="modify" value="Modifier"></td>
						 </tr>
						 <?php
					 }}
					 if(isset($_GET['modify'])){
						 $p_requete3 = $bdd->prepare('select image, nom, prenom, mail from utilisateur where utilisateur.IDutilisateur = :code ');
						 $p_requete3 -> execute(array('code'=> $_GET['id']));
							 if ($donnees3 = $p_requete3->fetch()){
							 ?>
							 <tr>
								 <td><img src="<?php echo $donnees3['image'];?>"style="width:100px;height:100px;"></td>
								 <td><input type="text" name="nom" value="<?php echo $donnees3['nom'];?>"></td>
								 <td><input type="text" name="prenom" value="<?php echo $donnees3['prenom'];?>"></td>
								 <td><input type="mail" name="mail" value="<?php echo $donnees3['mail'];?>"></td>
							 </tr>
							 <tr>
								 <td colspan="4"><input type="submit" name="modifier" value="Valider"></td>
							 </tr>
							 <?php
						 }}
						?>
				 </div>
		 </table>
	 </form>
 </div>
</div>
<?php
}

function ficheProfil(){
	global $bdd;
	$p_requete = $bdd->prepare('select image, nom, prenom, mail, IDutilisateur from utilisateur where utilisateur.IDutilisateur = :code ');
  $p_requete -> execute(array('code'=> $_GET['code']));
    if ($donnees = $p_requete->fetch()){
      ?>
      <div class="row small-up-1 medium-up-1 large-up-1">
        <div class="column">
          <form method="post">
            <table id="user">
              <h1>Fiche de <?php echo $donnees['prenom']; ?> </h1>
              <div id="tab">
                <tr>
                  <th>Photo</th>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>Adresse mail</th>
                </tr>
                <tr>
                  <td><label for="file">Image : </label><img src="<?php echo $donnees['image'];?>"style="width:100px;height:100px;"><p><input type="file" name="file" id="file"/></p></td>
                  <td><label for="nom"></label><input type="text" name="nom" id="nom" value="<?php echo $donnees['nom'];?>"></td>
                  <td><label for="prenom"><input type="text" name="prenom" id="prenom" value="<?php echo $donnees['prenom'];?>"></td>
                    <td><label for="mail"><input type="email" name="mail" id="mail" value="<?php echo $donnees['mail'];?>"></td>
                    </tr>
                    <tr>
                      <td colspan="4" >
                        <input type="submit" name="modifier" value="modifier">
                        <input type="submit" name="supprimer" value="supprimer">
                        <input type="hidden" name="code" value="<?php echo $_GET["code"]; ?>">
                      </td>
                    </tr>
                  </div>
                </table>
              </form>
            </div>
          </div>
					<?php
	}
}

function livresReserves(){
	global $bdd; ?>
	<div class="row small-up-1 medium-up-1 large-up-1">
    <div class="column">
		  <form method="get" >
		    <table id="res">
		      <h3>Mes livres réservés</h3>
		      <tr>
		        <th>Nom du livre</th>
		        <th>Date début</th>
		        <th>Date fin </th>
		      </tr>
		      <?php
		      $id = $_SESSION['code'];
		      $reponse2 = $bdd->query("SELECT Titre,  Datedébut, Datefin from reservation, objet where reservation.IDobjet = objet.IDobjet and reservation.IDutilisateur = $id and reservation.Emprunté = 1");
		      while ($donnees2 = $reponse2->fetch()){
		        ?>
		        <tr>
		          <td><?php echo $donnees2['Titre'];?></td>
		          <td><?php echo $donnees2['Datedébut'];?></td>
		          <td><?php echo $donnees2['Datefin'];?></td>
		        </tr>
			    <?php  } ?>
			  </table>
			</form>
	  </div>
	</div>
<?php
}

function listeUtilisateur(){
	global $bdd; ?>
	<div class="row small-up-1 medium-up-1 large-up-1">
    <div class="column">
      <form method="get" action="nouvelUtilisateur.php">
        <table id="user">
          <h3>Listes des utilisateurs</h3>
          <div id="tab">
	          <tr>
	            <th>Nom</th>
	            <th>Prenom</th>
	          </tr>
	          <?php
	         	$id = $_SESSION['code'];
	          $p_reponse = $bdd->query('select nom, prenom, IDutilisateur from utilisateur');
	            while ($donnees = $p_reponse->fetch()){
	              ?>
	          <tr>
	            <td><a href="ficheutilisateur.php?id=<?php echo $id;?>&code=<?php echo $donnees['IDutilisateur'];?>"> <?php echo $donnees['nom'];?> </a></td>
	            <td><a href="ficheutilisateur.php?id=<?php echo $id;?>&code=<?php echo $donnees['IDutilisateur'];?>"> <?php echo $donnees['prenom'];?> </a></td>
	          </tr>
	            <?php } ?>
	          <tr>
	            <td colspan="2"><input type="hidden" name="id" value="<?php echo $_GET['id'];?>"><input type="submit" name="nouveauU" value="Nouveau"></td>
	          </tr>
        	</div>
      	</table>
      </form>
    </div>
  </div>
	<?php
}

function listeLivres(){
	global $bdd; ?>
	<div class="row small-up-1 medium-up-1 large-up-1">
    <div class="column">
      <form method="get" action="nouveauLivre.php">
        <table id="livres">
          <h3>Listes des livres</h3>
          <tr>
            <th>Image</th>
            <th>Auteur</th>
            <th>Titre</th>
          </tr>
          <?php
          $reponse = $bdd->query('SELECT image, objet.IDobjet as IDobjet, auteur.Nom, objet.Titre, objet.image from objet, auteur where auteur.IDauteur = objet.IDauteur');
          while ($donnees = $reponse->fetch()) {
            ?>
              <tr>
                <td><img src="<?php echo $donnees['image'];?>"style="width:100px;height:150px;"></td>
                <td><?php echo $donnees['Nom']; ?></td>
                <td><a href="fichelivre.php?IDobjet= <?php echo $donnees['IDobjet']; ?> "> <?php echo $donnees['Titre']; ?></a></td>
              </tr>
              <?php
            } ?>
            <tr>
							<td colspan="3"><input type="submit" name="nouveauL" value="Nouveau"></td>
            </tr>
          </table>
        </form>
      </div>
    </div>
<?php
}

function listeLivresReserves(){
	global $bdd; ?>
	<div class="row small-up-1 medium-up-1 large-up-1">
		<div class="column">
			<form method="get" action="action.php">
				<table id="res">
					<h3>Liste livres réservés</h3>
					<tr>
						<th>Nom du livre</th>
						<th>Emprunté par</th>
						<th>Date début</th>
						<th>Date fin </th>
						<th>Date rendu</th>
						<th>Contact</th>
						<th>Marqué comme</th>
					</tr>
					<?php
					$reponse2 = $bdd->query('SELECT objet.Titre as Titre, utilisateur.Nom as Nom, reservation.Datedébut as Datedébut, reservation.Datefin as Datefin, reservation.dateRendu as dateRendu, objet.IDobjet as IDobjet, reservation.IDutilisateur as IDutilisateur from reservation, objet, utilisateur where reservation.IDobjet = objet.IDobjet and reservation.IDutilisateur = utilisateur.IDutilisateur and reservation.Emprunté = 1');
					while ($donnees2 = $reponse2->fetch()){
						?>
						<tr>
							<td><?php echo $donnees2['Titre'];?></td>
							<td><?php echo $donnees2['Nom'];?></td>
							<td><?php echo $donnees2['Datedébut'];?></td>
							<td><?php echo $donnees2['Datefin'];?></td>
							<td><?php echo $donnees2['dateRendu'];?></td>
							<td><input type="submit" name="mail" value="Contacter">
								<input type="hidden" name="id" value="<?php echo $donnees2['IDutilisateur']; ?>">
								<input type="hidden" name="code" value="<?php echo $_GET['id']; ?>">
							<a href="mailto:fpinaud17@gmail.com?subject=Test&body=Hello%20World"><input type="button"name="" value="sendMail"></a></td>
			</form>
			<form method="get" action="action.php">
				<td>
					<input type="submit" name="rendu" value="Rendu">
					<input type="hidden" name="livre" value="<?php echo $donnees2['IDobjet'];?>">
					<input type="hidden" name="code" value="<?php echo $_GET['id']; ?>">
				</td>
		</tr>
		<?php  } ?>
		</table>
		</form>
		</div>
	</div>
<?php
}

function last(){
	?>
	<h1> Dernieres sorties </h1>
	<?php
	global $bdd;
	$query = $bdd->query('SELECT IDobjet, Titre, image, Nom from auteur, objet where objet.IDauteur = auteur.IDauteur ORDER BY IDobjet DESC LIMIT 5');
	while ($last = $query->fetch()){?>
	<div class="row news">
		<div class="large-12 columns">
			<div class="large-4 columns">
				<a href="fichelivre.php?IDobjet=<?php echo $last['IDobjet']; ?>">
				<img src="<?php echo $last['image'];?>">
			</div>
			<div class="large-8 columns">
				<p>Titre : <?php echo $last['Titre'];?><br /> Auteur: <?php echo $last['Nom']; ?></p>
				</a>
			</div>
		</div>
	</div>
	<?php }
}
?>
