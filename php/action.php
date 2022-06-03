<?php
 include_once('base.php');
 if (isset($_GET['t'],$_GET['id']) AND !empty($_GET['t']) AND !empty($_GET['id'])) {
 	  $check = $bdd->prepare("SELECT * FROM article WHERE id = ?");
 	  $check->execute(array(intval($_GET['id'])));

 	  $get_t = (int) $_GET['t'];
 	  $getid = (int) $_GET['id'];
 	  $ip = $_SERVER['REMOTE_ADDR'];

 	  if ($check->rowCount() > 0) {
 	  	if ($get_t == 1) {
 	  		$check_like = $bdd->prepare("SELECT * FROM likes WHERE id_article = ? AND id_menbre = ?");
 	  		$check_like->execute(array($getid,$_SESSION['id']));

 	  		$check_row = $bdd->prepare("SELECT * FROM dislikes WHERE id_article = ? AND id_menbre = ?");
 	  		$check_row->execute(array($getid,$_SESSION['id']));

 	  		if ($check_like->rowCount() == 0) {
	 	  		$ins = $bdd->prepare("INSERT INTO likes(id_article,id_menbre) VALUES(?,?)");
	 	  		$ins->execute(array($getid,$_SESSION['id']));

	 	  		$delete = $bdd->prepare("DELETE FROM dislikes WHERE id_article = ? AND id_menbre = ?");
 	  			$delete->execute(array($getid,$_SESSION['id']));	 	  		
	 	  		header('Location: '.$_SERVER['HTTP_REFERER']); 	  			
 	  		}
 	  		else{
 	  			$delete = $bdd->prepare("DELETE FROM likes WHERE id_article = ? AND id_menbre = ?");
 	  			$delete->execute(array($getid,$_SESSION['id']));
	 	  		header('Location: '.$_SERVER['HTTP_REFERER']); 	  				
 	  		}
 	  	}

 	  	elseif ($get_t == 2) {
 	  		$check_like = $bdd->prepare("SELECT * FROM dislikes WHERE id_article = ? AND id_menbre = ?");
 	  		$check_like->execute(array($getid,$_SESSION['id']));

 	  		$delete = $bdd->prepare("DELETE FROM likes WHERE id_article = ? AND id_menbre = ?");
 	  		$delete->execute(array($getid,$_SESSION['id']));
	 	  		header('Location: '.$_SERVER['HTTP_REFERER']); 	  				
 	  		if ($check_like->rowCount() == 0) {
	 	  		$ins = $bdd->prepare("INSERT INTO dislikes(id_article,id_menbre) VALUES(?,?)");
	 	  		$ins->execute(array($getid,$_SESSION['id']));
	 	  		header('Location: '.$_SERVER['HTTP_REFERER']); 	  			
 	  		}
 	  		else{
 	  			$delete = $bdd->prepare("DELETE FROM dislikes WHERE id_article = ? AND id_menbre = ?");
 	  			$delete->execute(array($getid,$_SESSION['id']));
	 	  		header('Location: '.$_SERVER['HTTP_REFERER']); 	  				
 	  		}
 	  	}
 	  	else{
 	  		header('Location:index.php'); 	  	
 	  	}
 	  }
 }



 ?>