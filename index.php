<?php

require_once('key.php');

$lat = 58.248;
$lon = 22.539;

$url = "https://api.openweathermap.org/data/2.5/weather?units=metric&lat={$lat}&lon={$lon}&appid={$key}";

$cache = 'cache.json';
$now = time();
$timeout = 600;

if (!file_exists($cache) || ($now - filemtime($cache)) > $timeout ) {
    $content = file_get_contents($url);
    file_put_contents($cache, $content);

} else {
    $content = file_get_contents($cache);
}

$obj = json_decode($content);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$obj->name; ?> Ilm</title>
</head>
<body>
    <h3>Asukoht</h3>
    <h4><?= $obj->name;?></h4>

    <h3>Temperatuur</h3>
    <h4><?= $obj->main->temp;?></h4>
    
    <img src="http://openweathermap.org/img/wn/<?= $obj->weather[0]->icon; ?>@2x.png">
</body>
</html>