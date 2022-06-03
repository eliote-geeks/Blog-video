<?php 
include_once('php/base.php');
$response = array(
	'status' => 0,
	'message' => 'Form failed comment'
);

if (isset($_POST['commentaire'],$_POST['pseudo']) AND !empty($_POST['commentaire']) AND !empty($_POST['pseudo'])) {
	$pseudo = htmlspecialchars($_POST['pseudo']);				
	$commentaire = htmlspecialchars($_POST['commentaire']);
	$idcom = $_POST['idcom'];
		if (strlen($pseudo < 30)) {					
			if (preg_match("/^[a-zA-Z ]*$/",$pseudo)) {
				$ins = $bdd->prepare("INSERT INTO commentaire(pseudo,commentaire,id_article,date_com) VALUES(?,?,?,NOW())");
				$ins->execute(array($pseudo,$commentaire,intval($idcom)));							
				$response['message'] = "Nice comment!! ";
			}
			else{
				$response['message'] = "Error Username ";
			}					
	}
	else{
		$response['message'] = "Your username require min 30 chars!!";
	}
}
else{
	$response['message'] = "Field  input can't be empty !!";
}

echo json_encode($response);
 ?>