<?php
 include_once('../php/base.php');
 $_SESSION = array();
 session_destroy();
 header('Location:login-page.php');


 ?>