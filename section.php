<?php 
include_once('php/rowcount.php');

if (isset($_GET['id'])) {
  $cat_id =  $bdd->prepare("SELECT * FROM cat_article WHERE id = ? ORDER BY id DESC");
  $cat_id->execute(array(htmlspecialchars($_GET['id'])));
  $c_id = $cat_id->fetch();


  $idcat = $bdd->prepare("SELECT * FROM article WHERE categorie = ?");
  $idcat->execute(array($c_id['nom']));

  
    $article = $bdd->prepare("SELECT * FROM article
    RIGHT JOIN cat_article ON cat_article.nom = article.categorie 
    LEFT JOIN souscategoriearticle ON souscategoriearticle.nom_sous = article.sous_categorie 
    WHERE cat_article.nom = ?
    ORDER BY article.id DESC ");  
    $article->execute(array($c_id['nom']));
    if ($article->rowCount() == 0) {
      $article = "Aucun resultat";
    }
}

if (isset($_GET['valid'])) {
  if (isset($_GET['search']) AND !empty($_GET['search'])) {
  $search = htmlspecialchars($_GET['search']);
  $article = $bdd->query('SELECT * FROM article WHERE titre LIKE "%'.$search.'%" OR contenu LIKE "%'.$search.'%" ORDER BY id DESC');    
  if ($article->rowCount() == 0) {
    echo "Aucun resultat";
  }
  }
}

if (!isset($_GET['id']) AND !isset($_GET['valid']) AND empty($_GET['id'])) {
  $article = $bdd->query("SELECT * FROM article WHERE type = 1 ORDER BY id DESC LIMIT ".$depart.",".$reponsesparpages);    
}
 ?>

            <!--     *********   FULL Background CARDS     *********      -->
        <div class="cards">
          <div class="container">
            <div class="title">
              <h3>
                <small>Categories Videos Actualites</small>

              </h3>
            </div>
            <div class="row">

                          <?php while($a = $article->fetch()){ 
                    $likes->execute(array($a['id']));
                    $dislikes->execute(array($a['id']));
              ?>
              <div class="col-lg-3 col-md-6">
                <div class="card card-blog card-background" data-animation="zooming">
                  <div class="full-background" style="background-image: url('assets/img/matthew-henry.jpg')"></div>
                  <div class="card-body">
                    <div class="content-bottom">
                      <h6 class="card-category"><?=$a['categorie']?></h6>
                      <a href="gallery.php?gal=<?=$a['id']?>">
                        <h3 class="card-title"><?=$a['titre']?></h3>
                        <h6 class="card-description"><?= substr($a['titre'],0,44)?>..</h6>
                      </a>
                    <img style="position: relative; top: -190px; left: 70px; font-size: 7px; cursor: pointer;" class="scrollup" src="assets/img/owl.video.play.png" class="play-btn" onclick='playVideo("assets/img/portfolio/<?=$a['photo']?>")' > 
                    </div>
                  </div>
                </div>
              </div> 
              <?php } ?>
            </div>
          </div>
        </div>
          <div class="video-player" id="videoPlayer">
    <video width="100%" controls autoplay id="myVideo" class="form-control" style="height: 600px;">
      <source src="">
    </video>
        <img src="assets/img/close.gif" class="close-btn" onclick="stopVideo()">
  </div>
