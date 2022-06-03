<?php
  include_once('../php/base.php');
   include_once('entete.php'); 
  // include_once('../php/connexion.php');
?>

<body class="register-page">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top navbar-transparent " color-on-scroll="100">
    <div class="container">
      <?php include_once('logo.php'); ?>
      <div class="collapse navbar-collapse justify-content-end" id="navigation">
          <?php include_once('logomobile.php'); ?>


      </div>
    </div>
  </nav>
  <!-- End Navbar -->
<div class="squares square1"></div>
  <div class="squares square2"></div>
  <div class="squares square3"></div>
  <div class="squares square4"></div>
  <div class="squares square5"></div>
  <div class="squares square6"></div>
  <div class="page-header">    
    <div class="page-header-image"></div>
    <div class="container">
                <div id="square1" class="square square-1"></div>
          <div id="square2" class="square square-2"></div>
          <div id="square3" class="square square-3"></div>
          <div id="square4" class="square square-4"></div>
          <div id="square5" class="square square-5"></div>
          <div id="square6" class="square square-6"></div>
      <div class="col-lg-5 col-md-8 mx-auto">
                  <div id="square1" class="square square-1"></div>
        <div class="card card-login">
                           <form class="form" method="post" action="" autocomplete="off" id="myform">
            <div class="card-header">
              <img class="card-img" src="../assets/img/square-purple-1.png" alt="Card image">
              <h4 class="card-title" style="font-style: 8px;">LOGIN</h4>
            </div>
              <div id="form-message" style="font-size: 30px;"></div>
            <div class="card-body">
              <div class="input-group input-lg">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="tim-icons icon-email-85"></i></span>
                </div>
                <input type="text" name="email" placeholder="Entrez votre addresse email" class="form-control" required>
              </div>
              <div class="input-group input-lg">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="tim-icons icon-lock-circle"></i></span>
                </div>
                      <input type="text" name="password" class="form-control" placeholder="Entrez votre mot de passe" required>                
              </div>
            </div>
            <div class="card-footer text-center">
                <button href="javascript:void(0)" name="form_connexion" type="submit" class="btn btn-info btn-round btn-lg">Allez-y</button>
            </div>
            <div class="pull-left ml-3 mb-3">
              <h6>
                <a href="#pablo" class="link footer-link">Mot de passe oublie</a>
              </h6>
            </div>
            <div class="pull-right mr-3 mb-3">
              <h6>
                <a class="link footer-link" style="font-size: 10px; text-align: center;" href="register-page.php">Je ne suis pas inscris Inscription</a>
              </h6>
            </div>
          </form>

                  </div>
      </div>      
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
        url: "sign/sign-in-ajax.php",
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
            location.href = "index-video.php";
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

</html>
