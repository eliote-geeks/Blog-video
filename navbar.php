
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top navbar-info " color-on-scroll="200">
    <div class="container">
      <div class="navbar-translate">
        <a class="navbar-brand" href="index-video.php" rel="tooltip" title="Merci • d'aimez et de partagez •" data-placement="bottom" >
          <span>FATHER•</span> vIDEO sYSTEM pAUL
        </a>
        <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse justify-content-end" id="navigation">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a>
                fATHEr•pAUL
              </a>
            </div>
            <div class="col-6 collapse-close text-right">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
            </div>
          </div>
        </div>
        <ul class="navbar-nav">
          <li class="nav-item p-0">
            <a class="nav-link" rel="tooltip" title="Follow us on Twitter" data-placement="bottom" href="https://twitter.com/CreativeTim" target="_blank">
              <i class="fab fa-twitter"></i>
              <p class="d-lg-none d-xl-none">Twitter</p>
            </a>
          </li>
          <li class="nav-item p-0">
            <a class="nav-link" rel="tooltip" title="Like us on Facebook" data-placement="bottom" href="https://www.facebook.com/CreativeTim" target="_blank">
              <i class="fab fa-facebook-square"></i>
              <p class="d-lg-none d-xl-none">Facebook</p>
            </a>
          </li>
          <li class="nav-item p-0">
            <a class="nav-link" rel="tooltip" title="Follow us on Instagram" data-placement="bottom" href="https://www.instagram.com/CreativeTimOfficial" target="_blank">
              <i class="fab fa-instagram"></i>
              <p class="d-lg-none d-xl-none">Instagram</p>
            </a>
          </li>

          <li class="dropdown nav-item">
            <a href="./Resi/indexForum.php" class=" nav-link">
              <i class=""></i> Forum 
            </a>
            </li>  
          <li class="dropdown nav-item">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
              <i class="fa fa-cogs d-lg-none d-xl-none"></i> Commencez 
            </a>
            <div class="dropdown-menu dropdown-with-icons">
              <?php if(!isset($_SESSION['id'])){ ?>
              <a href="menbre/login-page.php" class="dropdown-item">
                <i class="tim-icons icon-paper"></i> CONNEXION
              </a>

              <a href="menbre/register-page.php" class="dropdown-item">
                <i class="tim-icons icon-bullet-list-67"></i>INSCRIPTION
              </a>
            <?php }else{ ?>
              <a href="menbre/deconnexion-page.php" class="dropdown-item">
                <i class="tim-icons icon-bullet-list-67"></i>DECONNEXION 
              </a>
                            <a href="menbre/deconnexion-page.php" class="dropdown-item">
                <i class="tim-icons icon-bullet-list-67"></i>CREER 
              </a>
            <?php } ?>
<!--               <a href="examples/profile-page.html" class="dropdown-item">
                <i class="tim-icons icon-single-02"></i>Profile Page
              </a> -->
            </div>
          </li>
<?php 
@include_once('php/base.php');
$ca = $bdd->query("SELECT * FROM cat_article WHERE vue = 1 ORDER BY id DESC");
$c = '';
  while($cat = $ca->fetch()){
    $c .=' <a href="cat_video.php?cat_id='.$cat['id'].'" class="dropdown-item">
                <i class="tim-icons icon-paper"></i> '.$cat['nom'].'
              </a>' ;
              
  }

 ?>
           <li class="dropdown nav-item">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
              <i class="fa fa-cogs d-lg-none d-xl-none"></i> Categories video
            </a>
            <div class="dropdown-menu dropdown-with-icons">

              <?php echo $c; ?>
            </div>
          </li>

          <li class="nav-item">
            <a class="btn btn-gray active" rel="tooltip" title="Follow us on Instagram" data-placement="bottom" href="https://www.instagram.com/CreativeTimOfficial" target="_blank" onclick="scrollToDownload()">
              <i class="tim-icons icon-user"></i> FAIRE UN DON
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>