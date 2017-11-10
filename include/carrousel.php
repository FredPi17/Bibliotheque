<?php 
  function carrousel(){
echo'
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script><!-- /**Le jquery ne se trouve pas dans le download boot strap on est obligé de le récupérer enligne!*/-->  
  <script src="js/bootstrap.min.js"></script>    
  <style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 70%; /**Règle ta taille de carrousel /a width*/
      margin: auto;
  }
  </style>
</head>
<body>

<div class="container">
  <br>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li> <!--noublie pas dajouter une nouvelle ligne si tu veut des diapo en plus!-->
    </ol>

    <!-- Met tes photos ici -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="image/st.jpg" alt="Chania" width="460" height="345"> <!-- Met tes photos dans les /a img src, et règle la hauteur que tu veut! -->
      </div>

      <div class="item">
        <img src="image/JCVD.jpg" alt="The Muscles From Brussels" width="460" height="345">
      </div>
    
      <div class="item">
        <img src="image/AS.jpg" alt="The Ostritch from Austria" width="460" height="345">
      </div>

      <div class="item">
        <img src="image/CS.jpg" alt="The Chuck" width="460" height="345">
      </div>
    </div>

    <!--/* Sa ces les 2 bouttons /a previous et /a next! -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

</body>
</html>';
}
?>
