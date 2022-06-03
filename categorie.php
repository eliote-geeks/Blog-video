
<!-- End Section Tabs -->
      <div class="section section-pills" style="margin-top: -100px">
        <div class="container">
          <div id="navigation-pills">
            <div class="title">
              <h4>Categories</h4>
            </div>
            <div class="row">
              <div class="col-md-6">
                <p class="category">Set a categorie</p>
                <ul class="nav nav-pills nav-pills-primary">
<?php while($c = $catego->fetch()){ ?>                 
                  <li class="nav-item">
                    <a class="nav-link active" href="cat_video.php?cat_id=<?=$c['id']?>" >
                      <?=$c['nom']?>
                    </a>
                  </li>
<?php } ?>
                </ul>
            </div>
        </div>
    </div>
 </div>
</div>          
      <br>
          <br>