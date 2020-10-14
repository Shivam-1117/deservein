<?php
$url = 'https://gnews.io/api/v3/top-news?token=9b3b2d029b9a8ea7e99c5ca5bb5ce467&lang=en&country=in&max=5';
$response = file_get_contents($url);
echo $response;
?>
