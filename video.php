        <div class="section">
          <div class="container">
            <div class="title">
              
            </div>
           
<?php 
include_once('php/base.php');
include_once('php/rowcount.php');


$page = 1;
$article = $bdd->prepare("SELECT * FROM article WHERE categorie = ? ORDER BY id DESC LIMIT ".$depart.",".$reponsesparpages);
$article->execute(array($vct['nom']));

if (isset($_GET['sous_categorie'])) {
    $_GET['sous_categorie'] = intval($_GET['sous_categorie']);
  $ouscat = $bdd->prepare("SELECT * FROM souscategoriearticle WHERE id = ? ORDER BY id DESC");
  $ouscat->execute(array(htmlspecialchars($_GET['sous_categorie'])));
  
  if ($ouscat->rowCount() == 0) {
      // die('erreur oups cette page n\' existe pas !! <a href="index-video.php">Retour a la page d\'acceuil</a>');
    header('Location:error.php');
    die();
  }


  $ouscategorie = $ouscat->fetch();



  $reponsesparpages = 4;
  $reponsesTotallesReq = $bdd->prepare("SELECT * FROM article WHERE sous_categorie = ?");
  $reponsesTotallesReq->execute(array($ouscategorie['nom_sous']));
  $reponsestotal = $reponsesTotallesReq->rowCount();
  $pagesTotales = ceil($reponsestotal/$reponsesparpages);

  if (isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND  $_GET['page'] <= $pagesTotales) {
      $_GET['page'] = intval($_GET['page']);
      $pageCourante = $_GET['page'];
  }
  else{
      $pageCourante = 1;
  }

  $depart = ($pageCourante - 1) * $reponsesparpages;
  
  // $pour plus de photo = .$depart.",".$reponsesparpages; pagination
  $article = $bdd->prepare("SELECT * FROM article 
    LEFT JOIN souscategoriearticle ON article.sous_categorie = souscategoriearticle.nom_sous
     LEFT JOIN cat_article ON cat_article.nom = article.categorie
      WHERE article.type = 1
       AND souscategoriearticle.id = ? ORDER BY article.id DESC LIMIT ".$depart.",".$reponsesparpages);
  $article->execute(array(intval($_GET['sous_categorie'])));

}


            // <div class="row justify-content-between align-items-center" style="width:100%;">
            //   <div class="col-lg-5 mb-5 mb-lg-10 " style="margin-left: 120px;">
            //     <h1 class="text-white font-weight-light"></h1>
            //     <p class="text-white mt-4">.</p><br>
                
            //                                       <a href="" class="btn-sm btn-pink mt-3"> Voir plus de video de cette section
            //                       <i class="icon tim-icons icon-download"></i>
            //      </a>
            //   </div>
            //   <div class="col-lg-5">
            //     <div id="carouselExampleControls" class="carousel slide">
            //       <div class="carousel-inner">
            //         <div class="carousel-item active">
            //           <img class="d-block w-100" src="assets/img/chester-wade.jpg" alt="Second slide">
                      
            //         </div> <br>
            //       </div>

            //     </div>
            //   </div>
            // </div>
?>
<h3 style="border:1px solid gray;"><?php echo @$ouscategorie['nom_sous']; ?></h3>
<?php 
$data = '';
if($article->rowcount() > 0){
 while($a = $article->fetch()){
    $likes->execute(array(get_video($a['titre'])));
    $dislikes->execute(array(get_video($a['titre'])));
    $comm->execute(array($a['id']));
    while($com = $comm->fetch())
{
    $data = "<label class=\"btn-sm btn-dwarning mt-4\">Commentaires (".$comm->rowCount().")</label>
                <label> Dernier commentaire: <a href=\"\">".$com['pseudo'].":</a> ".substr($com['commentaire'],0,50)."..</label>";
}
 ?>
<!--         <div class="section">
          <div class="container">
            <div class="title">
              <h3>Carousel</h3>
            </div>
            <div class="row justify-content-between align-items-center">-->
 <div class="row justify-content-between align-items-center">              
<div class="col-lg-5 mb-5 mb-lg-0 ">
                <h1 class="text-white font-weight-light"><?=$a['titre']?></h1>
                <p class="text-white mt-4"><?=substr($a['contenu'],0,280).".."?></p>
                <a class="btn-sm btn-info mt-4" href="video-view.php?gal=<?=get_video($a['titre'])?>" >Voir</a>
                <label class="btn-sm btn-dwarning mt-4">Publie le <?=datet($a['date_time_publication'])?></label>
                <?php echo $data; ?>
              </div>
        <div class="col-lg-6">
                <div id="carouselExampleControls" class="carousel slide">
                  <div class="carousel-inner">

                    <div class="carousel-item active">
                      <img style="border-radius: 5px;" class="d-block w-100" src="assets/img/randy-colas.jpg" alt="First slide">
                    </div>
<!--                       <i style="font-size: 90px;  left: 180px; cursor: pointer;" class="tim-icons icon-triangle-right-17" onclick='playVideo("assets/img/portfolio/<?=$a['photo']?>")'></i> -->
            <i class="tim-icons icon-single-02"></i>
                  </div>

                </div>
              </div>


</div><br><br><br>

        <?php 
      }?>
            <div class="col-md-12">
              <h3 class="mb-5">Page Suivante</h3>
              <ul class="pagination pagination-primary">
            <?php for($i=1; $i < $pagesTotales ; $i++){ 
                  if ($i == $pageCourante) { ?>
                <li class="page-item active">
                  <a class="page-link" href="#"><?=$i?></a>
                </li>
                <?php }
              else{ ?>
                <li class="page-item">
                  <?php if (isset($_GET['sous_categorie'])) {?>
                  <a class="page-link" href="cat_video.php?cat_id=<?=$vct['id']?>&sous_categorie=<?=$ouscategorie['id']?>&page=<?=$i?>"><?= $i ?></a>
                  <?php }else{ ?>
                    <a class="page-link" href="cat_video.php?cat_id=<?=$vct['id']?>&page=<?=$i?>"><?= $i ?></a>              
                  <?php } ?>
                </li>
                       <?php } ?>                        
            <?php } ?>
              </ul>
              <br>
            </div>
          
      </div>


                <div class="video-player" id="videoPlayer">
    <video width="100%" controls autoplay id="myVideo" class="form-control" style="height: 600px;">
      <source src="">
    </video>
        <img src="assets/img/close.gif" class="close-btn" onclick="stopVideo()">
  </div>
        <?php 
    }else{
      include_once 'error.php';
      die();
    }

    include_once('script.php');
      ?>
          </div>
        </div>