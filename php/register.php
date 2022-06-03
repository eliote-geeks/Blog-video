<?php 
include_once('base.php');
if (isset($_POST['valid'])) {
	if (isset($_POST['pseudo'],$_POST['email'],$_POST['pass'],$_POST['pass2'],$_POST['req']) AND !empty($_FILES['photo'])) {
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$email = htmlspecialchars($_POST['email']);
		$mdp = htmlspecialchars($_POST['pass']);
		$mdp2 = htmlspecialchars($_POST['pass2']);
		// $ip = $_SERVER['REMOTE_ADDR'];
		$pseudolen = strlen($pseudo);
		if ($pseudolen >= 4)
		{
			 if(($pseudolen<=20)) {
				if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
					$mail = $bdd->prepare("SELECT * FROM menbres WHERE email = ?");
					$mail->execute(array($email));
					if ($mail->rowCount() == 0) {
						if ($mdp == $mdp2) {
							$ps = $bdd->prepare("SELECT * FROM menbres WHERE pseudo = ?");
							$ps->execute(array($pseudo));
							if (($ps->rowCount() == 0)) {
								$lk = 12;
								$k = "";
								for ($i=0; $i < $lk; $i++) { 
									$k .= mt_rand(0,9).str_shuffle("le roi paul");
								}					
								  $photo = htmlspecialchars($_FILES['photo']['name']);
								  $file_tmp_name = $_FILES['photo']['tmp_name'];
								  $photo_verify =  move_uploaded_file($file_tmp_name,"../assets/img/profiles/$photo");	
								  if ($photo_verify) {
									$pass = sha1($mdp);
									$insert = $bdd->prepare("INSERT INTO menbres(photo,pseudo,email,password) VALUES(?,?,?,?)");
									$insert->execute(array($photo,$pseudo,$email,$pass));						

									$upt = $bdd->prepare("UPDATE menbres SET statuts =  'en ligne' WHERE pseudo = ?");
									$upt->execute(array($pseudo));
									header('Location:login-page.php');					  	
								  }
								  else{
								  	$erreur = "Erreur d'extension";
								  }
						      }
							else{
								$erreur = "Oups votre pseudo existe deja";
							}
						}
						else{
							$erreur = "Oups vos mots de passes ne correspondent pas";
						}
					}
					else{
						$erreur = "Oups cette addresse email exste deja";
					}
				}
				else{
					$erreur = "Adresse email invalide";
				}
			}
			else{
				$erreur = "Veuillez saisir les identifiants valides";
			}
		}
		else{
			$erreur = "Votre pseudo doit etre superieur a 4 caracteres minimum";
		}

	}
	else{
		$erreur = "Tous les champs doivent etre rempli";
	}
}
?>
