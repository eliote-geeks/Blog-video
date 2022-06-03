
<?php
  $notif_site = $notifications->fetch(); 
    ?>
	      <div style="margin-top: -120px;" class="section section-notifications" id="notifications">
        <div class="container">
          <div class="space"></div>
          <h6 align="center"><< <?=$notif_site['annonce']?> >> </h6>
          <div class="alert alert-primary alert-with-icon">
            <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
              <i class="tim-icons icon-simple-remove"></i>
            </button>
            <span data-notify="icon" class="tim-icons icon-coins"></span>
        <span style="text-align: center;">
            <?php if($notif_site['afficher'] == 1){ ?>
              <b> - </b> <?=$notif_site['congrat']?> - </span>
            <?php } ?>
          </div>

<!--           <div class="alert alert-info alert-with-icon">
            <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
              <i class="tim-icons icon-simple-remove"></i>
            </button>
            <span data-notify="icon" class="tim-icons icon-trophy"></span>
            <span>
              <b> Heads up! - </b> <?=$notif_site['info']?></span>
          </div>

          <div class="alert alert-success alert-with-icon">
            <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
              <i class="tim-icons icon-simple-remove"></i>
            </button>
            <span data-notify="icon" class="tim-icons icon-bell-55"></span>
            <span>
              <b> Well done! - </b> <?=$notif_site['success']?></span>
          </div>

          <div class="alert alert-warning alert-with-icon">
            <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
              <i class="tim-icons icon-simple-remove"></i>
            </button>
            <span data-notify="icon" class="tim-icons icon-bulb-63"></span>
            <span>
              <b> Warning! - </b> <?=$notif_site['danger']?></span>
          </div> -->
        </div>
      </div>