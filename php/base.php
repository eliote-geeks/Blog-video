<?php 
session_start();
$bdd = new PDO("mysql:host=127.0.0.1;dbname=forum;charset=utf8",'root','');
include_once('fonctions.php');
$path = 'http://localhost/father/blk-design-system-master';
setlocale(LC_TIME, 'fr');
//Gestion de la langue
$langues = $bdd->query("SELECT * FROM inscription_lan");
$lang = $langues->fetch();

//Gestion des notifications
$notifications = $bdd->query("SELECT * FROM notif_site ORDER BY id DESC LIMIT 0,1");



 ?>