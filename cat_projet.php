<?php 
include_once('php/base.php');
include_once 'php/rowcount.php';
include_once('head.php');
include_once('navbar.php');
if (isset($_GET['cat_id'])) {
$projet = $bdd->prepare("SELECT * FROM projet WHERE id = ?");
$projet->execute(array(intval($_GET['cat_id'])));
if ($projet->rowCount() > 0) { 
      $p = $projet->fetch();
  ?>
 <body class="index-page">
 

<div class="main" style="margin-top: -40px;">

  <div class="section section-examples" data-background-color="black">
        <img src="assets/img/path1.png" class="path">
        <div class="space-50"></div>
        <div class="container text-center">
          <div class="row">
            
            <div class="col-sm-6">
              <a href="">
                <img src="assets/img/profile-page.png" alt="Image" class="img-raised">
              </a>
              <a href="" class="btn btn-simple btn-primary btn-round"><?=$p['titre']?></a>
              <a href="" class="btn btn-simple btn-primary btn-round"><?=$p['description']?></a>
                <a href="" class="btn btn-simple btn-primary btn-round">Telecharger</a>
            </div>
         
          </div>
        </div>
      </div>


</div>

 <?php
include_once('script.php');
include_once('newlestter.php');
  include_once('php/footer.php'); 

}
}
else
  die('oups');
?>
 </body>
 </html>