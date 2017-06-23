<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bibliotheque | Accueil</title>
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
  <link rel="stylesheet" href="style/css/about.css">
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <!-- /**Le jquery ne se trouve pas dans le download boot strap on est obligé de le récupérer enligne!*/-->
  <script src="js/bootstrap.min.js"></script>

</head>

<?php
session_start();
include("include/outils.php");
include("include/utilisateur.php");
echo menuConnexion();
echo Menu();
?>
<h1>Site crée par...</h1>
  <div class="card card-user">
    <!--<div class="image">
        <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>
    </div>-->
    <div class="content">
        <div class="author">
            <img class="avatar border-gray" src="image/fred.jpg" alt="..."/>
            <div class="info">
              <h4 class="title">Frédéric Pinaud<br />
              </h4>
            </a>

        <p class="description"> "Etudiant B1 EPSI Grenoble" <br>
                            Site web: <a  href="http://fredericpinaud.fr">fredericpinaud.fr</a> <br>
                            Mail: frederic.pinaud@epsi.fr
        </p>
        </div>
      </div>
    </div>
  </div>

  <div class="card card-user">
    <!--<div class="image">
        <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>
    </div>-->
    <div class="content">
        <div class="author">
            <img class="avatar border-gray" src="image/joseph.jpg" alt="..."/>
            <div class="info">
              <h4 class="title">Joseph Tabailloux<br />
              </h4>
            </a>

        <p class="description"> "Etudiant B1 EPSI Grenoble"  <br>
                            Mail: joseph.tabailloux@epsi.fr
        </p>
        </div>
      </div>
    </div>
  </div>

  <div class="card card-user">
    <!--<div class="image">
        <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>
    </div>-->
    <div class="content">
        <div class="author">
            <img class="avatar border-gray" src="image/hugo.jpg" alt="..."/>
            <div class="info">
              <h4 class="title">Hugo Lausenaz-Pire<br />
              </h4>
            </a>

        <p class="description"> "Etudiant B1 EPSI Grenoble"  <br>
          Site web: <a href="http://hugolausenazpire.fr/">hugolausenazpire.fr</a> <br>
          Mail: hugo.lausenazpire@epsi.fr
        </p>
        </div>
      </div>
    </div>
  </div>

  <div class="card card-user">
    <!--<div class="image">
        <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>
    </div>-->
    <div class="content">
        <div class="author">
            <img class="avatar border-gray" src="image/loris.jpg" alt="..."/>
            <div class="info">
              <h4 class="title">Loris Rabatel<br />
              </h4>
            </a>

        <p class="description"> "Etudiant B1 EPSI Grenoble" <br>
                            Site web: Site en construction <br>
                            Mail: loris.rabatel@epsi.fr
        </p>
        </div>
      </div>
    </div>
  </div>
<?php

echo piedPage();
