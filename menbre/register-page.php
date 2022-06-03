<?php
  include_once('../php/base.php');
  include_once('entete.php'); 
  include_once('../php/register.php');


  $cat = $bdd->query("SELECT * FROM cat_article ORDER BY id DESC");
  
  
?>


<body class="register-page">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top navbar-transparent " color-on-scroll="100">
    <div class="container">
      <?php include_once('logo.php'); ?>
      <div class="collapse navbar-collapse justify-content-end" id="navigation">
          <?php include_once('logomobile.php'); ?>
          <style type="text/css">
            div{
              display: flex;
              flex-wrap: wrap;
              display: table-caption;
            }
          </style>

      </div>
    </div>
  </nav>
  <!-- End Navbar -->


  <div class="wrapper">
    <div class="page-header">
      <div class="page-header-image"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-5 col-md-12 mx-auto">
            <div id="square7" class="square square-7"></div>
            <div id="square8" class="square square-8"></div>
            <div class="card card-register">
              <div class="card-header">
                <img class="card-img" src="../assets/img/square1.png" alt="Card image">
                <h4 class="card-title">INSC.</h4>
              </div>
              <div class="card-body">
                  <form class="form" method="post" action="" autocomplete="off" enctype="multipart/form-data" id="myform">
                    <div style="display: none;" id="form-message" style="font-size: 10px;" class="alert alert-danger">Veuillez remplir tous les champs</div>

                                        <div class="input-group">
                      <select type="text" name="categorie"  class="form-control" required style="background-color: #000;">
                          <option>Choisissez votre categorie</option>
                          <?php while ($a = $cat->fetch()) { ?>
                            <option ><?=$a['nom']?></option>
                          <?php } ?>
                      </select>
                    </div>

                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="tim-icons icon-single-02"></i>
                        </div>
                      </div>
                      <input type="text" class="form-control" placeholder="<?=$lang['place_pseudo']?>" name="username" required>
                    </div>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="tim-icons icon-email-85"></i>
                        </div>
                      </div>
                      <input type="text" name="email" placeholder="<?=$lang['place_email']?>" class="form-control" required>
                    </div>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="tim-icons icon-lock-circle"></i>
                        </div>
                      </div>
                      <i class="fas fa-eye-slash show_hide"></i>
                      <input spellcheck="false" type="text" id="input" name="password" class="form-control" placeholder="<?=$lang['place_password']?>" required>
                    </div>
                    <div class="indicator">
                      <div class="icon-text">
                        <i class="fab fa-exclamation-circle error_icon"></i>
                        <h6 class="text"></h6>
                      </div>
                    </div>

                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="tim-icons icon-lock-circle"></i>
                        </div>
                      </div>
                      <i class="fas fa-eye-slash show_hide"></i>
                      <input type="text" name="password2" class="form-control" placeholder="<?=$lang['place_confirm']?>" required>
                    </div>

                    <div class="form-check text-left">

                        <a href="javascript:void(0)">En validant ce formulaire vous acceptez nos terms et conditions d'utilisation.</a>.
                      </label>
                    </div>
                <div class="card-footer">
                  <button href="javascript:void(0)" name="valid" type="submit" class="btn btn-info btn-round btn-lg">Inscription</button>
                </div>
                  </form>
                  <a href="login-page.php">Je suis inscris Connexion</a>
                </div>

            </div>
          </div>
        </div>
      </div>
      <div class="register-bg"></div>
      <div id="square1" class="square square-1"></div>
      <div id="square2" class="square square-2"></div>
      <div id="square3" class="square square-3"></div>
      <div id="square4" class="square square-4"></div>
      <div id="square5" class="square square-5"></div>
      <div id="square6" class="square square-6"></div>
    </div>
  </div>



    <?php include_once('footer.php'); ?>
  </div>
  <?php include_once('script.php'); ?>
</body>
<script type="text/javascript">
  $(document).ready(function(){
    $("#myform").on('submit',function(e){
      e.preventDefault();
      $.ajax({
        type: "POST",
        url: "sign/sign-up-ajax.php",
        data: new FormData(this),
        dataType: "json",
        contentType:false,
        cache:false,
        processData:false,
        success:function(response){
          $(".form-message").css("display","block");
          if (response.status == 1) {
            $("#myform")[0].reset(); 
            $("#form-message").css("color","green");
            $("#form-message").html('<p>' + response.message + '</p>');
              location.href = "login-page.php";
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

