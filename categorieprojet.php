
<div class="section section-pagination" style="margin-top: -760px;">
        <img src="assets/img/path4.png" class="path">
        <img src="assets/img/path5.png" class="path path1">
        <div class="container">
          <div class="row">
            <div class="col-md-6">

              <br>
              <h3 class="mb-5">CATEGORIE PROJET</h3>
              <ul class="nav nav-pills nav-pills-primary nav-pills-icons">
                <?php while($cp = $cat_projet->fetch()){ ?> 
                <li class="nav-item">
                  <a class="nav-link active show"  href="cat_video.php?cat_id=<?=$cp['id']?>">
                    <i class="tim-icons icon-atom"></i><?=$cp['nom_cat']?> 
                  </a>
                </li>
              <?php } ?> 
              </ul>
            </div>
          </div>
        </div>
    </div>