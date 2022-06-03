<?php 
include_once('php/base.php');
// include_once('php/rowcount.php');
// include_once('head.php');

$current_date = explode('-',date('Y-m-d'));
var_dump($current_date);
if (isset($_POST['age'])) {
	$date = htmlspecialchars($_POST['date']);
	$age = explode('-', $date);
	$age_menbre = $current_date[0]-$age[0];
	var_dump($age_menbre);
}

 ?>
<body class="index-page">
<?php
include_once('navbar.php');?>
<br><br><br><br>
<?php 
 include_once('notification.php'); ?>
<!-- <div class="wrapper">
	  <div class="page-header header-filter">
      <div class="container">
        <div class="content-center brand"><br><br><br><br>
          <h6 style=" font-size: 16px;" class="h1-seo">•• Rechercher un projet ••</h6>
          <form method="post" action="" autocomplete="off">
          	<input type="search" class="form-control" placeholder="entrez votre recherche" style="border-radius: 10px 0 0 13px;" name=""> <button type="submit" class="btn btn-gray" style="margin-top: -52px; margin-left: 37em; height:  38px; border-radius: 0 12px 10px 0;">Search</button>
          </form>
        </div>
      </div>
</div> -->
<form method="post" action="">
	<label>note</label>
	<input type="date" name="date">
	<button type="submit" name="age">Envoyer</button>
</form>
<div class="main">
<?php
 // include_once('categorieprojet.php'); 
 // include_once('projets.php'); 

 ?>
 <div class="content-center">
 <?php 
// include_once('newlestter.php');
?>
</div>
</div>



</div>

<!-- <?php include_once('menbre/footer.php'); ?>
<?php include_once('script.php'); ?> -->
</body>
</html>