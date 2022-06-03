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
                  <a class="page-link" href="index.php?page=<?=$i?>"><?= $i ?></a>
                </li>
                       <?php } ?>                        
            <?php } ?>
              </ul>
              <br>
            </div>
          </div>
          <br>
        </div>
      </div>