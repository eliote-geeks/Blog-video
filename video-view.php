<?php 
  include_once('php/base.php');
  include_once 'php/rowcount.php';
  include_once('head.php');
  include_once('php/fonctions.php');
  include_once('navbar.php');

if (isset($_POST['select'])) {
   header('Location:index-video.php?gal='.$_POST['select']);
}

   $idcom = intval($_GET['gal']);
  if (isset($_GET['gal'])) {
    //la variable de la video selectionne
    $gal = intval($_GET['gal']);
    $gallery = $bdd->prepare("SELECT * FROM article WHERE id = ?");
    $gallery->execute(array($gal));
    if ($gallery->rowCount() > 0) {
      //recuperons toutes les donnes da la table article bref des videos car j'ai appele la table qui stoke les videos article
      $vd = $gallery->fetch();

      //Selectionnons les autres videos lies a la video 
      $autre = $bdd->prepare("SELECT * FROM article WHERE sous_categorie = ? AND id != ? ORDER BY id ASC");
      $autre->execute(array($vd['sous_categorie'],$gal));
      $vdp = $bdd->prepare("SELECT * FROM article WHERE id = ?");
      $vdp->execute(array($gal));
      $vdpri = $vdp->fetch();
    }
    else{
      include_once('error.php');
      die();
    }
  }
  else{
    header('Location:index-video.php');
  }

 ?><br><br>

<style type="text/css">
  <style>
html, body {
  margin: 0px;
  padding: 0px;
  font-family:Verdana, Geneva, sans-serif;
  background-color: #1a1a1a;
  text-align: center;
  width: 100%;
    height: 100%; 
}

</style>
<meta name="google" value="notranslate" /> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<!-- <link rel="stylesheet" type="text/css" href="video/css/styles.css"> -->
    <div class="section about-description">
      <img src="../assets/img/path4.png" class="path path4">
      <div class="container">
        <div >
            

      </div>
            <nav class="navbar navbar-expand-lg fixed navbar-transparent " color-on-scroll="100">
              <h6>Playist:</h6>  
    <div class="container">
      <div class="navbar-translate">
        	          <li class="dropdown nav-item" style="list-style: none;">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" style="border: 0.5px solid #fff; width: 300px; text-align: center;">
              <i class="fa fa-cogs d-lg-none d-xl-none"></i> <?=$vd['titre']?>
            </a>
            <div class="dropdown-menu dropdown-with-icons">
        <?php
$id = array();
         while($autrevd = $autre->fetch()){ 
         	$id[] = $autrevd['id'];
  //        	foreach ($id as $key => $value) {	
		// 		var_dump($key." ".$value); 	
		// }
        	?>

              <a href="video-view.php?gal=<?=$autrevd['id']?>" style="width: 300px;text-align: center;" class="dropdown-item" >
                <i class="tim-icons icon-video-66" style="color: #000222;"></i> <?=$autrevd['titre']?>
              </a>
		<?php } ?>
            </div>
          </li>
      </div>
  </div>
</nav>
<!-- button next and preview -->
            <?php
            $min = $max =0;
            $mid_max = array(); 
            $mid_min = array();
            $mid = intval($vd['id']);

            for ($i=0; $i <count($id) ; $i++) {             	

            	if($id[$i] > $max)	            		
            		$max = $id[$i];


            	if($id[$i] < $min)
            		$min = $id[$i];

            	if ($id[$i] > $mid) {
            		 $mid_max[] = $id[$i];
            	}
            	else{
            		$mid_min[] = $id[$i];
            	}
            }
$prec = 0;
$next = 0;
            
            	for($i = 0; $i<count($mid_max); $i++)
            		$next = $mid_max[0];

            	

            	 for($i = 0; $i<count($mid_min); $i++){
            		$prec = $mid_min[count($mid_min)-1];            		
            	 }

		
		 ?>        <!-- <button type="submit" class="btn btn-info">Envoyer</button> -->
                    </form><br>
                    <label class="title"><i class="tim-icons icon-video-66"></i>&nbsp; <?=$vd['titre']?></label>
                    
          
                     <h4 style="text-decoration: underline;" class="title"></h4>
                                         <nav aria-label="breadcrumb" role="navigation">

<nav aria-label="breadcrumb" role="navigation">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index-video.php">Home</a></li>
    <li class="breadcrumb-item"><a href=""><?=$vd['categorie']?></a></li>
    <li class="breadcrumb-item"> <a href=""><?=$vd['sous_categorie']?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?=$vd['titre']?></li>
  </ol>
</nav>
                     <label style="text-decoration: underline;"><i class="tim-icons icon-tv-2"></i>&nbsp; index/<?=$vd['categorie']?>/<?=$vd['sous_categorie']?>/<?=$vd['titre']?></label>
          <div class="col-md-12 ml-auto mr-auto" >
            <div class="container text-right" >
                      <?php if(in_array($prec, $mid_min)){ ?>
                        <a  href="video-view.php?gal=<?php echo $prec; ?>" style=" " class="btn-sm btn-warning"><i class="tim-icons icon-double-left"></i> PREC </a>
                    <?php } ?>

	<?php if(in_array($next, $mid_max)){ ?>                        
            <a  href="video-view.php?gal=<?php echo $next; ?>" style=" margin-left: 10px; " class="btn-sm btn-info">NEXT <i class="tim-icons icon-double-right"></i></a>
          <?php } ?>
            </div>
            


            <video class="card" width="100%" controls autoplay id="myVideo" style="width: 100%;" controls class="tscplayer_inline" id="embeddedSmartPlayerInstance" scrolling="no" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen>
              <source src="assets/video/portfolio/<?=$vd['photo']?>" type="video/MP4" >
                <div class="progress-container">
    
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                        <span class="progress-value">25%</span>
                    </div>
                </div>
</div>
            </video>


                <div class="row mb-5">
          <div class="col-md-12 ml-auto mr-auto text-rigth">
            <label class="title"><i class="tim-icons icon-video-66"></i>&nbsp;Title <br> <?=$vd['titre']?>: <span class="tim-icons icon-spaceship"><?=$vd['sous_categorie']?></span></label><br>

            <label class="description"><i class="tim-icons icon-paper"></i>&nbsp;Resume:<br> <?=$vd['contenu']?>.</label><br>
             <label style="color:red;" class="description"><i class="tim-icons icon-time-alarm" style="color:red;"></i>&nbsp;Depuis le : <?=datet($vd['date_time_publication'])?>.</label>
          </div>
        </div> 
                  <?php if (CONNECTION_NORMAL): ?>
                    <i class="tim-icons icon-wifi"></i>
                  <?php endif ?>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
let select  = document.querySelector('#select');      
let  formselect = document.querySelector("#formselect");
let id = '';
select.addEventListener("change",()=>{
  id = select.val();
  //alert(id);

});
// alert(select);
    </script>
<script src="video/js/video-player.js"></script>
<?php    
    include_once('testcom.php'); 
    include_once('newlestter.php');
     include_once('script.php'); 
     include_once('php/footer.php');

    ?>
