<?php 
// include_once('../php/base.php');
$page = 1;
include_once('php/rowcount.php');
$ct = $bdd->prepare("SELECT * FROM cat_article WHERE id = ? ORDER BY id DESC");
  $ct->execute(array($getcat));
  $vct = $ct->fetch();

$ss = $bdd->prepare("SELECT * FROM souscategoriearticle WHERE cat = ? ORDER BY id DESC");
$ss->execute(array($vct['nom']));


$sc_total = $ss->rowCount();
$i  = 0;
$page = @$_GET['sous_categorie'];
 ?>
      <div class="section section-basic" id="basic-elements">
        <img src="assets/img/path1.png" class="path">
        <div class="container">
          <h2 class="title" style="text-transform: uppercase;">Vous etes actuelement dans la categorie <u style="color: red;"><?=$vct['nom']?></u></h2>
          <p class="category">Selectionner une sous categorie</p>
          <div class="row">
            <div class="col-md-12">
              <?php 
              $i = 1;
              // while($sss = $ss->fetch() AND $i <= $ss->rowCount()) { 
                  while($sss = $ss->fetch() AND $i <= $sc_total){         
                if (@$sss['id'] == @$_GET['sous_categorie']) {                
               ?>
              <a   class="btn btn-info btn-simple btn-round active" href="cat_video.php?cat_id=<?=$vct['id']?>&sous_categorie=<?= $sss['id']?>"><?=$sss['nom_sous']?></a>
            <?php
            }
           else{
            ?>
                <a href="cat_video.php?cat_id=<?=$vct['id']?>&sous_categorie=<?=$sss['id']?>" class="btn btn-info btn-simple btn-round"><?= $sss['nom_sous']?></a>
             <?php }
          
          $i++;
             } ?>
            </div>
          </div>
        </div>
      </div>


