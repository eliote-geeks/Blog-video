<?php 
include_once('php/base.php');
include_once 'php/rowcount.php';
include_once('head.php');
include_once('navbar.php');
include_once('php/fonctions.php');
if (isset($_GET['cat_id'])) {
  $getcat = intval($_GET['cat_id']);
  $ct = $bdd->prepare("SELECT * FROM cat_article WHERE id = ?");
  $ct->execute(array($getcat));
  if ($ct->rowCount() == 0) {
  	// Si l'utilisateur essaie d'entrez lui meme sa page
  	die('erreur oups cette page n\' existe pas !! <a class="btn btn-gray" href="index.php">Retour a la page d\'acceuil</a>');  	
  }
  $vct = $ct->fetch();

  $cat_video = $bdd->prepare("SELECT * FROM article WHERE categorie = ? AND type = 1 ORDER BY  id DESC" );
  $cat_video->execute(array($vct['nom']));
  if ($cat_video->rowcount() > 0) {
   ?>
 <style type="text/css">
 	
 	.video-player{
	width: 80%;
	position: absolute;
	left: 50%;
	top: 290px;
	transform: translate(-50%,-50%);
	display: none;
}
video:focus{
	outline: none;
}
.close-btn{
	position: absolute;
	top: 10px;
	right: 10px;
	width: 30px;
	cursor: pointer;
}
 </style>
 <body class="index-page">

 	<div class="wrapper">
	  <!-- <div class="page-header header-filter"> -->
<!--       <div class="squares square1"></div>
      <div class="squares square2"></div>
      <div class="squares square3"></div>
      <div class="squares square4"></div>
      <div class="squares square5"></div>
      <div class="squares square6"></div>
      <div class="squares square7"></div> -->
                           <div class="container" style="margin-top: 150px;">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="tim-icons icon-zoom-split"></i></span>
                              <!-- <p><b>Start typing a name in the input field below:</b></p> -->
                              </div>
                          <form> <input style="width: 400px;" type="text" class="input-group-text form-control" onkeyup="showHint(this.value)">
                          </form>
                            </div>
                            <div class="title">
                          <p>Suggestions: <span id="txtHint"></span></p>
                              <label ><a id="txtHint" href="index.php"></a></label>
                            </div>
                          </div> 

<div class="main">
<?php 
include_once('sc.php');
include_once('video.php');
 ?>
 <div class="content-center">

</div>
</div>
</div>
</div>
 <?php
include_once('script.php');
include_once('newlestter.php');
  include_once('php/footer.php'); ?>
 </body>
 </html>
 <?php 
}
else{
  include_once('error.php');
}

   }
  else{
     header('Location:error.php');
    
    
  }
  ?>