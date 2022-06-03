<?php
$bdd = new PDO("mysql:host=127.0.0.1;dbname=forum;charset=utf8",'root','');

if (isset($_POST['cancel'])) {
    header("Location: ../signup.php");
}
$code = $_SESSION['validate_code'];

if(isset($_POST['validate'])){
$username = $_SESSION['val_username'];
$password = $_SESSION['val_password'];
$email = $_SESSION['val_email'];
$gender = $_SESSION['val_gender'];
$dob = $_SESSION['val_dob'];
$presentCode = $_POST['code'];

$num_email = 0;
if($dob){
$n = explode('-',$dob);
//Used to print the content of an array
//print_r($n);

$age = $n[0];
$current_date = explode('-',date("Y-m-d"));

$age = $current_date[0]-$age;
}
$s = $bdd->query("SELECT * FROM patient WHERE email = '$email' ");
foreach ($s as $row) {
    $num_email+=1;
}
if($num_email>0 || $code!=$presentCode){
    echo "<script>alert('Code invalid OR Email Exist Already Try Again....')</script>";
}
if($num_email<=0 && $code==$presentCode){
$sql = "INSERT INTO patient (username,email,password,gender,dob,age,path) VALUES ('$username','$email','$password','$gender','$dob','$age','null')";
    $bdd->exec($sql);

        unset($_SESSION['val_username']);
        unset($_SESSION['val_password']);
        unset($_SESSION['val_email']);
        unset($_SESSION['val_gender']);
        unset($_SESSION['val_dob']);
        unset($_SESSION['validate_code']);

       	echo "<script>alert('Account Created Successfully....')</script>";
        header("Location: ../home.php");
    }
}

?>
<!Doctype html>
<html>
    <head>
        <title>Create Account</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    body{
        background-color:rgba(0,0,0,0.03);
    }
     .popup{
    width: 100%;
    height: 100%;
    position: absolute;
    z-index: 20;
    background-color:  rgba(0, 0, 0, 0.85);
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    align-items: center;
	}
	.subpopup{
	    overflow-y:  hidden;
	    margin:0% auto;
	    width:55%;
	    height:60%;
	    display: flex;
	    flex-direction: column;
	    justify-content: space-between;
	    align-items: center;
	    background-color: whitesmoke;
	    transition: margin 2s ease-in-out 150ms ;
	}
	.subpopup h1{
		color: green;
	}
	#validate,#cancel{
		width: 150px;
		height: 45px;
		background-color: #0000ffb3;
		color: white;
		font-size: 18px;
		font-weight: bold;
		border-radius: 4px;
		border:1px solid #0000ffb3;
		margin:2% 0;
	    transition: background-color 250ms ease-in-out 150ms ;
	}
	#cancel{
		background-color: #bf0a0a;
		border:1px solid #bf0a0a;
	}
	#cancel:hover{
		background-color: #941313;
		border:1px solid #941313;
		cursor: pointer;
	}
	#validate:hover{
		background-color:blue;
		border:1px solid blue;
	}
	input[name="code"]{
		font-size: 17px;
		font-weight: bold;
		color: black;
        width: 370px;
        height: 45px;
        border-radius: 4px;
	}
    </style>

    </head>
    <body>
    	<form class="popup" method="POST" action="validate.php">
            		<div class="subpopup">
            			<h1>VERIFY NOW</h1>
            			<input type="text" name="code" placeholder="Enter code sent to you in your email">
            			<div class="v_bottom">
	            			<input type="submit" id="cancel" value="Cancel" name="cancel">
	            			<button id="validate" name="validate">Validate</button>
            			</div>
            		</div>
        </form>

    </body>
</html>