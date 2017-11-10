<?php

$json = file_get_contents('https://www.googleapis.com/books/v1/volumes?q=isbn:9782070643059&apikey=AIzaSyCCziw_gHT4jQUbpPgl-D6ciV8lwy-om7c');

$json_decode = json_decode($json, true);

echo $json_decode['items'][0]['volumeInfo']['authors'][0].'<br /><br />';
echo $json_decode['items'][0]['volumeInfo']['description'].'<br /><br />';
echo $json_decode['items'][0]['searchInfo'];

?>
