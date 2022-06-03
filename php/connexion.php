<?php 
include_once("base.php");

if (isset($_POST['form_connexion'])) {
	if (isset($_POST['email'],$_POST['pass']) AND !empty($_POST['email']) AND !empty($_POST['pass'])) {
		$pseudo = htmlspecialchars($_POST['email']);
		$pass = htmlspecialchars($_POST['pass']);
		$pass = sha1($_POST['pass']);
		$req = $bdd->prepare("SELECT * FROM menbres WHERE email = ? AND password = ?");
		$req->execute(array($pseudo,$pass));

		if ($req->rowCount() == 1) {
			$user = $req->fetch();
			$_SESSION['id'] = $user['id'];
			$_SESSION['pseudo'] = $user['pseudo'];
			$_SESSION['first'] = $user['first'];
			$_SESSION['email'] = $user['email'];
			$_SESSION['password'] = $user['password'];
			$_SESSION['unique_id'] = $user['unique_id'];
			$_SESSION['status'] = $user['status'];
			$_SESSION['confirm'] = $user['confirm'];
			header('Location:../index.php?');
		}	
		else{
			$erreur = "Identifiants incorrects";
		}
	}
	else{
		$erreur = "Tous les champs doivent etre rempli";
	}
}


 ?>