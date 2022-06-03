<?php 
include_once('head.php');
include_once('navbar.php');
@include_once('php/base.php');



$reponsesparpages = 12;
$reponsesTotallesReq = $bdd->query("SELECT * FROM article ORDER BY id DESC");
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

$video = $bdd->query("SELECT * FROM article ORDER BY id DESC LIMIT ".$depart.",".$reponsesparpages);
 ?>
 <body class="blog-posts">
 	  <div class="wrapper">
    <div class="page-header page-header-small header-filter">
      <div class="page-header-image" data-parallax="true" style="background-image: url('assets/img/bg8.jpg');">
      </div>
      <div class="content-center">
        <div class="row">
          <div class="col-md-6 ml-auto mr-auto text-center">
            <h1 class="title">A Place for students learn and Discover New Stories</h1>
            <i class="tim-icons icon-pencil" style="text-decoration: underline;">Annonces</i>
                <div class="col-lg-6">
                  <h4 class="title">Get Tips &amp; Tricks every Week!</h4>

                </div>
                                <div class="col-lg-12">
                  <div class="card card-plain card-form-horizontal">
                    <div class="card-body">
                      <form method="" action="#">
                        <div class="row">
                           <div class="col-sm-12">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="tim-icons icon-zoom-split"></i></span>
                              <!-- <p><b>Start typing a name in the input field below:</b></p> -->
                              </div>
                          <form> <input type="text" class="input-group-text form-control" onkeyup="showHint(this.value)">
                          </form>
                            </div>
                            <div class="card-title">
                          <p>Suggestions: <span id="txtHint"></span></p>
                              <label ><a id="txtHint" href="index.php"></a></label>
                            </div>
                          </div> 



                          <div class="col-sm-12">
<!--                             <button type="button" class="btn btn-primary btn-round btn-block"><i class="fa fa-search"></i></button> -->
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
          </div>
        </div>
      </div>
    </div>

    <div class="main main-raised">
      <div class="container">
        <div class="row">
<?php while($v = $video->fetch()) { ?>
          <div class="col-lg-4 col-md-6">
            <div class="card card-blog card-plain">
              <div class="card-image">
                <a href="video-view.php?gal=<?=$v['id']?>">
                  <img class="img rounded" src="assets/img/unass.jpg">
                  <img style="width: 80px; height: 80px; border: 2px solid black; margin-top: -390px; position: relative; margin-left: 155px;" src="assets/img/owl.video.play.png" class="play-btn">
                </a>
              </div>
              <div class="card-body">
                <h6 class="category text-primary"><?=$v['categorie']?></h6>
                <h4 class="card-title">
                  <a href="video-view.php?gal=<?=$v['id']?>"><?=$v['titre']?></a>
                </h4>
                  <?php $mot = (strlen($v['contenu']) > 200) ? substr($v['contenu'],0,200).".."  : $mot = $v['contenu']; ?>
                <p class="card-description"><?php echo $mot; ?>
                </p>
                <div class="card-footer">
<!--                   <div class="author">
                    <img src="../assets/img/p10.jpg" alt="..." class="avatar img-raised">
                    <span>Mike John</span>
                  </div> -->
                  <div class="stats stats-right">
                    <i class="tim-icons icon-watch-time"></i> <?php echo datet($v['date_time_publication'])?>
                  </div>
                </div>
              </div>
            </div>
          </div>
      <?php } ?>
  </div>
</div>
</div>


     <div class="section section-pagination">
        <img src="assets/img/path4.png" class="path">
        <img src="assets/img/path5.png" class="path path1">
        <div class="container">
          <div class="row">
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
                  <a class="page-link" href="index-video.php?page=<?=$i?>"><?= $i ?></a>
                </li>
                       <?php } ?>                        
               <li class="page-item">
                  <a class="page-link active" href="index-video.php?page=<?=$i+1?>"><?= "..+" ?></a>
                </li>                       
            <?php } ?>
              </ul>
            </div>
          </div>
        </div>
<?php 
	//categorie video
	// $catego = $bdd->query("SELECT * FROM cat_article WHERE vue = 1 ORDER BY id DESC");
 ?>
      </div>

</div>
<?php 
include_once('newlestter.php');
include_once('menbre/footer.php');
include_once('script.php'); 

?>

 </body>