<?php 
include_once('php/base.php');
include_once('php/rowcount.php');

$projet = $bdd->prepare("SELECT * FROM projet WHERE categorie  = ?");
$projet->execute(array(intval($_GET['cat_id'])));
if ($projet->rowCount() > 0) {
	while($p = $projet){
 ?>

  <div class="section section-examples" data-background-color="black">
        <img src="assets/img/path1.png" class="path">
        <div class="space-50"></div>
        <div class="container text-center">
          <div class="row">
            <?php while($p = $project->fetch()){ ?>
            <div class="col-sm-6">
              <a href="examples/profile-page.html">
                <img src="assets/img/profile-page.png" alt="Image" class="img-raised">
              </a>
              <a href="examples/profile-page.html" class="btn btn-simple btn-primary btn-round">Voir <?=$p['titre']?></a>
            </div>
          <?php } ?>
          </div>
        </div>
      </div>

 <?php 
	}
}
else{
	die('erreur cette categorie ne contient pas encore de projets retour a la page d\'acceuil <a href="index.php"></a>');
}
include_once('script.php');

  ?>