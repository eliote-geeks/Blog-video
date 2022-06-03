<?php include_once('head.php'); 

$idcom = intval($_GET['gal']);

  $reponsesparpages = 6;
  $reponsesTotallesReq = $bdd->prepare("SELECT * FROM commentaire WHERE id_article = ?");
  $reponsesTotallesReq->execute(array($_GET['gal']));
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
  $commentaires->execute(array(intval($_GET['gal'])));


?>
<div id="comments" class="container">

         <div class="title">
                <h3>
                  <small>Comments (<?=$reponsesTotallesReq->rowCount();?>)</small>
                </h3>
                    <div style="margin-left: -30px;" class="media" id="reponse">


                    </div>

                    <!-- pagination -->
   <ul class="pagination pagination-primary justify-content-center">
               <?php for($i=1; $i < $pagesTotales ; $i++){ 
                  if ($i == $pageCourante) { ?>
                <li class="page-item active">
                  <a class="page-link" href="#"><?=$i?></a>
                </li>
                <?php }
              else{ ?>
                <li class="page-item">
                  <a class="page-link" href="video-view.php?gal=<?=$_GET['gal']?>&page=<?=$i?>"><?= $i ?></a>
                </li>
                       <?php } ?>                                               
            <?php } ?>
                            <li class="page-item">
                  <a class="page-link" href="video-view.php?gal=<?=$_GET['gal']?>&page=<?=$i?>">...</a>
                </li>
                    </ul> 


                    <!-- pagination -->
<!--                   </div> -->

      <form autocomplete="off" method="post" action="" id="myform">
                  <h4 class="text-center">Post your comment
                    <br>
                    <small class="text-muted">- Logged In  <?=$utilisateur['pseudo']?>- </small>
                  </h4>
                  
                  <div class="media media-post">
                    <a class="pull-left author" href="javascript:;">
                      <div class="">
                        <img class="media-object img-raised" <?php if(empty($pic['photo'])){ ?>src="assets/img/placeholder.jpg"  <?php } ?> style="width: 50px;" alt="64x64" src="assets/img/<?=$utilisateur['photo']?>">
                        <input type="text" name="pseudo" value="<?=$utilisateur['pseudo']?>" hidden>
                        <input type="text" name="idcom" value="<?=$_GET['gal']?>" hidden>
                      </div>
                    </a>
                    <div id="form-message"></div>
                    <div class="media-body">
                      <textarea class="form-control" id="comment" name="commentaire" placeholder="Write some nice stuff or nothing..." rows="6"></textarea>
                      <div class="media-footer">
                        <button type="submit" class="btn btn-primary btn-wd pull-right" id="submit">Post Comment</button>
                      </div>                      
                      <div id="display" style="color: green;"></div>
                    </div>
                  </div>
                </form>
                  <!-- end media-post -->
                </div>
              </div>
            </div>
            <!--                 end comments                 -->
          

<script type="text/javascript">
  let form = document.querySelector('#myform');
  let submit = document.querySelector("#submit");
  let comment = document.querySelector('#comment');
  let reponse = document.querySelector('#reponse');

  form.addEventListener('submit',(e)=>{ 
    e.preventDefault();    
  });


  submit.addEventListener('click',()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST",'comments.php',true);
    xhr.onload = ()=>{
      if (xhr.readyState == XMLHttpRequest.DONE) {
        if (xhr.status == 200) {
          let data = xhr.response;
          comment.value = " ";
         document.getElementById('display').innerHTML =  data;
        }
      }
    }
    let formData = new FormData(form);
    xhr.send(formData);  
  });

setInterval(()=>{
  let xhr = new XMLHttpRequest();
  xhr.open("POST",'commentaire-data.php',true);
  xhr.onload = ()=>{
    if (xhr.readyState == XMLHttpRequest.DONE) {
      if (xhr.status == 200) {
        let data = xhr.response;      
        reponse.innerHTML = data;           
      }
    }
  }
  let formData = new FormData(form);
  xhr.send(formData);
},500);


</script>
