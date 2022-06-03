<?php 
$q = $_REQUEST["q"];

include_once('php/base.php');
$article = $bdd->query('SELECT * FROM article WHERE titre LIKE "%'.$q.'%" ORDER BY id DESC');



// get the q parameter from URL


if(@$article){
$hint = "";

// lookup all hints from array if $q is different from ""
if ($q !== "") {
   $q = strtolower($q);
    $len=strlen($q);
    while($a = $article->fetch()) {
        if (stristr($q, substr($a['titre'], 0, $len))) {
            if ($hint === "") {
                 $hint = '<a href="video-view.php?gal='.$a['id'].'"  > '.$a['titre'].'</a> <br>';
            } else {
                $hint .='<a href="video-view.php?gal='.$a['id'].'"> &nbsp; '.$a['titre'].'</a>,';
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "Aucune suggestion" : $hint; 

}
else
echo "Aucune suggestion";
?>


