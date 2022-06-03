<?php 
$apikey = "AIzaSyCMpsi_3-jq7e8gg1A271HrBDX1WNjBBSE";
$channelId = "UCGGAoYKeiOotmiiKEQMvqNQ";
$maxResults = 20;
// https://youtube.googleapis.com/youtube/v3/search?key=[YOUR_API_KEY] HTTP/1.1

//GET https://youtube.googleapis.com/youtube/v3/search

//?part=paul&channelId=UCGGAoYKeiOotmiiKEQMvqNQ&maxResults=20&key=[YOUR_API_KEY] HTTP/1.1

$baseUrl = "https://youtube.googleapis.com/youtube/v3/search";

$url = $baseUrl."?part=snippet&order=date&channelId=".$channelId."&maxResults=".$maxResults."&key=".$apikey."";
$videoList = json_decode($url);
// print_r($videoList);

$url = file_get_contents($url);
print_r($url);




 ?>

