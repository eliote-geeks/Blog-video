<?php 

$showinput = 0;
if (isset($_GET['rep']) AND !empty($_GET['rep']) ) {
	$reponse = $bdd->prepare("UPDATE reponse SET showinput = 1 WHERE id = ?");
  $reponse->execute(array(intval($_GET['rep'])));
  $showinput = 1;

}
$photo = $bdd->prepare("SELECT * FROM menbres WHERE pseudo = ?");



		if (isset($_POST['valid'])) {
			if (isset($_POST['pseudo'],$_POST['commentaire']) AND !empty($_POST['pseudo']) AND !empty($_POST['commentaire'])) {
				$pseudo = htmlspecialchars($_POST['pseudo']);				
				$commentaire = htmlspecialchars($_POST['commentaire']);
				if (strlen($pseudo < 30)) {					
						if (preg_match("/^[a-zA-Z ]*$/",$pseudo)) {
							$ins = $bdd->prepare("INSERT INTO commentaire(pseudo,commentaire,id_article,date_com) VALUES(?,?,?,NOW())");
							$ins->execute(array($pseudo,$commentaire,intval($_GET['gal'])));							
						}
						else{
							$erreur = "Pseudo invalide";
						}					
				}
				else{
					$erreur = "Votre pseudo est beaucoup trop long";
				}
			}
			else{
				$erreur = "Tous les champs doivent etre rempli";
			}
		}


		if (isset($_POST['reponse'])) {
			if (isset($_POST['pseudo'],$_POST['commentaire']) AND !empty($_POST['pseudo']) AND !empty($_POST['commentaire']) AND ($_POST['commentaire'] != 'Votre commentaire ici')) {
				$pseudo = htmlspecialchars($_POST['pseudo']);				
				$commentaire = htmlspecialchars($_POST['commentaire']);
				$id_commentaire = htmlspecialchars($_POST['id_commentaire']);
				$pseudo_author = htmlspecialchars($_POST['pseudo_author']);
				if (strlen($pseudo < 30)) {					
						if (preg_match("/^[a-zA-Z ]*$/",$pseudo)) {
							$ins = $bdd->prepare("INSERT INTO reponse(pseudo,reponse,id_commentaire,pseudo_author,date_rep) VALUES(?,?,?,?,NOW())");
							$ins->execute(array($pseudo,$commentaire,$id_commentaire,$pseudo_author));												
							$showinput = 0;
						}
						else{
							$erreur = "Pseudo invalide";
						}					
				}
				else{
					$erreur = "Votre pseudo est beaucoup trop long";
				}
			}
			else{
				$erreur = "Tous les champs doivent etre rempli";
			}
		}


	$commentaires = $bdd->prepare("SELECT * FROM commentaire WHERE id_article = ? ORDER BY date_com DESC");
	$commentaires->execute(array(intval($_GET['gal'])));

	$reponse = $bdd->prepare("SELECT * FROM reponse WHERE id_commentaire = ? ORDER BY id ASC");

 ?>
      <!-- Typography -->
      <div class="section section-typo"  id="comment">
        <img src="assets/img/path1.png" class="path">
        <img src="assets/img/path3.png" class="path path1">
        <div class="container">
          <h2 class="title" style="font-weight: bold; font-family: Poppins-black;">Commentaires</h2>
          <div id="typography">
            <div class="row">
            	<?php if ($commentaires->rowCount() == 0) {
            		echo "<p>Aucun commentaire soyez la premiere personne a reagir!! </p>";
            	} ?>
            	<?php while($c = $commentaires->fetch()){ 
            		$reponse->execute(array($c['id']));
                $photo->execute(array($c['pseudo']));
                $pic = $photo->fetch();
            		?>


              <div class="col-md-7">
                    <span>
                    	<img src="assets/img/<?php echo $pic['photo'];?>" style=" border-radius: 50%; width: 50px; float: left;" >
                    </span>
                <div class="typography">                	
              	<span style="margin: 20px; color: white; width: 200%;"><?=$c['pseudo']?></span>
                  <p style="margin: 20px;">                    
                    <?=$c['commentaire']?><br>
                    <?=$c['date_com']?>
                  </p>
                  <?php while($r = $reponse->fetch()){
                      $photo->execute(array($r['pseudo']));
                      $picture = $photo->fetch();
                   ?>

                <div class="col-md-7">
                    <span>
                      <img src="assets/img/<?php echo $picture['photo'];?>" style=" border-radius: 50%; width: 50px; float: left; margin-left: 140px;" >
                    </span>
                <div class="typography" style="margin-left: 140px; width: 200%;">                  
                <span style=" margin: 20px; color: white;"><?=$r['pseudo']?></span>
                  <p style="margin: 20px;">                    
                    <?=$r['reponse']?><br>
                    <?=$r['date_rep']?>
                  </p>
                  </div>
                  </div>
                <?php } ?>
                	<a href="gallery.php?gal=<?=$_GET['gal']?>&rep=<?=$c['id']?>" onclick="reponse();"  style="float: right;"> Repondre</a>


                
					<div class="container commentaire"  style="margin-top: -50px; display: none;">
	<div class="row">
 		<div class="col-lg-12">
 			<form method="post" action="" autocomplete="off">
 				          <div class="space-70"></div>
          <div id="inputs">
            <!-- <h3>Inputs</h3> -->
            <p class="category">Repondre a ce commentaire</p>
            <div class="row">
              <?php if(isset($erreur)) echo $erreur; ?>
              <div class="col-sm-12 col-lg-12">
                <div class="form-group">
                 <u><a style="font-size: 18px;" href=""> <?=$utilisateur['pseudo']?></a></u>
                 <input type="text" name="pseudo" value="<?=$utilisateur['pseudo']?>" hidden>
                </div>
              </div>
				<div class="form-group" hidden>
				<label>commentaire_id<span>*</span></label>
				<input type="text" name="id_commentaire" value="<?= $c['id']?>">
			</div>
			<div class="form-group" hidden>
				<label>pseudo autor<span>*</span></label>
				<input type="text" name="pseudo_author" value="<?= $c['pseudo']?>">
			</div>        
              <div class="col-sm-6 col-lg-6">
                <div class="form-group">
                	<textarea autocomplete="off" name="commentaire" required  placeholder="Entrez un commentaire" class="form-control" rows="5">Votre commentaire ici </textarea>
                </div>
              </div>
            <div class="col-sm-6 col-lg-8">
                <div class="form-group">
                  <input type="submit" name="reponse" value="Envoyer" class="btn btn-info" />
                </div>
              </div>
            </div>
          </div>
 			</form>
 		</div>
	</div>
</div>                		
<br><br>
 </div>
    </div><br><br>
          <?php } ?>

                    

            </div>
          </div>
      </div>
  </div>




<div class="container" style="margin-top: -50px;">
	<div class="row">
 		<div class="col-lg-12">
 			<form method="post" action="" autocomplete="off" id="myform">
 				          <div class="space-70"></div>
          <div id="inputs">
            <!-- <h3>Inputs</h3> -->
            <p class="category">Poster un commentaire votre avis compte beaucoup</p>
            <div class="row">

              <div class="col-sm-6 col-lg-12">
                <div class="form-group">
                 <u><a style="font-size: 18px;" href=""> <?=$utilisateur['pseudo']?></a></u>
                 <input type="text" name="pseudo" value="<?=$utilisateur['pseudo']?>" hidden>
                </div>
              </div>

              <div class="col-sm-6 col-lg-6">
                <div class="form-group">
                	<textarea autocomplete="off" name="commentaire" required  placeholder="Entrez un commentaire" class="form-control" rows="5">Votre commentaire ici </textarea>
                </div>
              </div>

              <div class="col-sm-6 col-lg-8">
                <div class="form-group">
                  <input type="submit" name="valid" value="Envoyer" class="btn btn-info" />
                </div>
              </div>

            </div>
          </div>
 			</form>
 		</div>
    		
	</div>
</div>

  <script type="text/javascript">
  $(document).ready(function(){
    $("#myform").on('submit',function(e){
      e.preventDefault();
      $.ajax({
        type: "POST",
        url: "comments.php",
        data: new FormData(this),
        dataType: "json",
        contentType:false,
        cache:false,
        processData:false,
        success:function(response){
          $(".form-message").css("display","block");
          if (response.status == 1) {
            $("#myform")[0].reset(); 
            $("#form-message").html('<p>' + response.message + '</p>');
          }
          else{
            $("#form-message").css("display","block");
             $("#form-message").css("color","red");
            $("#form-message").html('<p>' + response.message + '</p>');           
          }
        }
      });
    });

  });
</script>