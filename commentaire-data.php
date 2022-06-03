<?php 
 include_once('php/base.php');
include_once('php/fonctions.php');


  $idcom = $_POST['idcom'];

  if (isset($_GET['rep'])) {
    $rep = $bdd->prepare("SELECT * FROM commentaire WHERE id = ?");
    $rep->execute(array(intval($_GET['rep'])));
    if($rep->rowCount() > 0){
      $up = $bdd->prepare("UPDATE commentaire SET view = 1 WHERE id = ? ");
      $up->execute(array(intval($_GET['rep'])));
      // header('HTTP_REFERER');
    }
  }

  $reponsesparpages = 6;
  $reponsesTotallesReq = $bdd->prepare("SELECT * FROM commentaire WHERE id_article = ?");
  $reponsesTotallesReq->execute(array($idcom));
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

  $photo = $bdd->prepare("SELECT * FROM menbres WHERE pseudo = ?");
  $commentaires = $bdd->prepare("SELECT * FROM commentaire WHERE id_article = ? ORDER BY date_com DESC LIMIT ".$depart.",".$reponsesparpages);
  $commentaires->execute(array(intval($idcom)));
?>

                       
<?php 
  while($c = $commentaires->fetch()){
  $photo->execute(array($c['pseudo']));
  $pic = $photo->fetch();


	 if($commentaires->rowCount() == 0)
                        echo "No comments";
                       ?>
   <!-- <meta http-equiv="refresh" content="5">  -->
                      <a  href="javascript:;">
                        <div class="  " style=" width: 30px; height: 30px; margin-left: -30px;">
                          <img style="margin-left: -30px; width: 30px;" class="media-object img-raised" alt="<?=$c['pseudo']?> Picture" <?php if(empty($pic['photo'])){ ?>src="assets/img/placeholder.jpg"  <?php } ?> src="assets/img/<?php echo $pic['photo'];?>">
                        </div>
                      </a>

                      <div class="media-body">
                        <h5 class="media-heading"><?=$c['pseudo']?>
                          <small class="text-muted">&middot; <?=datet($c['date_com'])?></small>
                        </h5>
                        <p><?=$c['commentaire']?>.</p>

                        <div class="media-footer">                   
                        <br> 
                        </div>
<?php } ?>                       

                      </div> 

<script type="text/javascript">
  $(document).on('click','#res',()=>{
    var comment_id = $(this).attr("id");
    $ 
  });
</script>