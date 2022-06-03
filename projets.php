<?php 
@include_once('php/base.php'); 
$projects = $bdd->query("SELECT * FROM projet ORDER BY id DESC");
  ?>
      <div class="section section-examples" data-background-color="black">
        <img src="assets/img/path1.png" class="path">
        <div class="space-50"></div>
        <div class="container text-center">
          <div class="row">
            <?php while($p = $projects->fetch()){ ?>
            <div class="col-sm-6">
              <a href="cat_projet.php?cat_id=<?=$p['id']?>">
                <img src="assets/img/profile-page.png" alt="Image" class="img-raised">
              </a>
              <a href="cat_projet.php?cat_id=<?=$p['id']?>" class="btn btn-simple btn-primary btn-round">Voir <?=$p['titre']?></a>
            </div>
          <?php } ?>
          </div>
        </div>
      </div>