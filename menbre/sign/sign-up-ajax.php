<?php 
include_once('../../php/base.php');

$response = array(
	'status' => 0,
	'message' => 'Form failed validation'
);

$errorEmpty = false;
$errorEmail = false;

if (isset($_POST['email'],$_POST['password'],$_POST['username']) AND !empty($_POST['email']) AND !empty($_POST['password']) AND !empty($_POST['username'])) {
	$username = htmlspecialchars($_POST['username']);
	$email = htmlspecialchars($_POST['email']);
	$categorie = html_entity_decode($_POST['categorie']);
	$password = sha1(htmlspecialchars($_POST['password']));
	$password2 = sha1(htmlspecialchars($_POST['password2']));
	if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
		if (preg_match("/^[a-zA-Z]*$/", $username)) {  //preg_match("/^[a-zA-Z ]*$/",$pseudo)
			$reqmail = $bdd->prepare("SELECT *  FROM menbres WHERE email = ?");
			$reqmail->execute(array($email));
			if ($reqmail->rowCount() == 0) {
				$requser = $bdd->prepare("SELECT * FROM menbres WHERE pseudo = ?");
				$requser->execute(array($username));
				if ($requser->rowCount() == 0) {
					if ($password == $password2) {						
						if (strlen($password) > 6) {
							$password = sha1($password);
							$cat_v = $bdd->prepare("SELECT * FROM cat_article WHERE nom = ?");
							$cat_v->execute(array($categorie));
							if ($cat_v->rowCount() > 0) {
								$insert = $bdd->prepare("INSERT INTO menbres(pseudo,email,password,categorie,date_en)  VALUES(?,?,?,?,NOW()) ");
								$insert->execute(array(trim($username),trim($email),trim($password),$categorie));
								$response['message'] = "ok All is nice!!";				
							}
							else{
								$response['message'] = "Oups this categorie not exist!!";	
							}
						}
						else{
							$response['message'] = "Please your  password is too low!!";							
						}
					}
					else{
						$response['message'] = "Oups your password not equal!!";
					}

				}else{
					$response['message'] = "Your username already exist";
				}
			}
			else{
				$response['message'] = "Please your email already exist";
			}
		}
		else{
			$response['message'] = "No special chiars to username!! ";
		}
	}
	else{
		$response['message'] = "Your address email is invalid";
	}

		}
else{
	$response['message'] = "Please field input can't be empty !!";
}

echo json_encode($response);

 ?>