<?php 
include_once('../../php/base.php');

$response = array(
	'status' => 0,
	'message' => 'Echec de validation de formulaire'
);

$errorEmpty = false;
$errorEmail = false;

if (isset($_POST['email'],$_POST['password']) AND !empty($_POST['email']) AND !empty($_POST['password'])) {
	$email = htmlspecialchars($_POST['email']);
	$password = sha1(htmlspecialchars($_POST['password']));
	$req = $bdd->prepare("SELECT * FROM menbres WHERE email = ? AND password = ?");
	$req->execute(array($email,$password));
		if ($req->rowCount() == 1) {
			$user = $req->fetch();
			$_SESSION['id'] = $user['id'];
			$_SESSION['pseudo'] = $user['pseudo'];
			$_SESSION['email'] = $user['email'];
			$_SESSION['password'] = $user['password'];
			$response['message'] = "<a style='text-decoration:underline;' href='../index-video.php'>Cliquez ici !!";	 
		}
          else{
          	$response['message'] = "Identifiants incorrects!!";
          }
		}
else{
	$response['message'] = "S'il vous plait veuillez remplir tous les champs !!";
}

echo json_encode($response);

 ?>