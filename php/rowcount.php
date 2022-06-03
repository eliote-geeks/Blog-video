<?php 
include_once('php/base.php');
$req = $bdd->prepare("SELECT * FROM menbres WHERE id = ?");
$req->execute(array($_SESSION['id']));
if ($req->rowCount() > 0) {
	$utilisateur = $req->fetch();
	

	$reponsesparpages = 8;
	$reponsesTotallesReq = $bdd->query("SELECT * FROM article");
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
	//Categorie projets
	
	// $menbres = $bdd->query("SELECT * FROM menbres ORDER BY id");
	//categorie video
	$catego = $bdd->query("SELECT * FROM cat_article WHERE vue = 1 ORDER BY id DESC");
	//sous categorie video
	$souscategories = $bdd->query("SELECT * FROM souscategoriearticle ORDER BY id DESC");
	//likes
	$likes = $bdd->prepare("SELECT * FROM likes WHERE id_article = ?");
	//dislikes
	$dislikes = $bdd->prepare("SELECT * FROM dislikes WHERE id_article = ? ORDER BY id DESC");
	//article les plus aimee
	$plusaime = $bdd->query("SELECT * FROM article LEFT JOIN likes ON likes.id_article = article.id WHERE likes.id_article >= 2 ");
	//categorie projets
	$cat_projet = $bdd->query("SELECT * FROM projet_cat WHERE afficher = 1 ORDER BY id DESC");
	//dernier message 
	$f_message = $bdd->prepare("SELECT * FROM f_message WHERE id_posteur = ?");
	$f_message->execute(array($utilisateur['id']));
	$f_likes = $bdd->prepare("SELECT * FROM likes WHERE id_menbre = ?");
	$f_likes->execute(array($utilisateur['id']));


	//Comentaire par article
	$comm = $bdd->prepare('SELECT * FROM commentaire WHERE id_article = ? ORDER BY id ASC');
}
else{
	header('location:./menbre/login-page.php');
}

 ?>


