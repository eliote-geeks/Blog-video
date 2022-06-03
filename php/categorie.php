<?php 
include_once("base.php");


$reponsesParpages = 12;
$reponsesTotalesReq = $bdd->query("SELECT * FROM f_cathegories");
$reponsesTotales = $reponsesTotalesReq->rowCount();
$pagesTotales = ceil($reponsesTotales/$reponsesParpages);
if (isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND  $_GET['page'] <= $pagesTotales) {
    $_GET['page'] = intval($_GET['page']);
    $pageCourante = $_GET['page'];
}else{
    $pageCourante = 1;
}
    $depart = (($pageCourante-1) * $reponsesParpages);


$categories = $bdd->query("SELECT * FROM f_cathegories ORDER BY nom DESC LIMIT ".$depart.",".$reponsesParpages);
$subcat = $bdd->prepare("SELECT * FROM f_sous_categories WHERE id_categories = ? ORDER BY nom");

 ?>