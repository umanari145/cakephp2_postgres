<?php

$file_path = __DIR__. "/app/Config/bootstrap.php";
$configBefore = file_get_contents($file_path);

$debugPattern = "/CakeLog::config\('debug',(.*?)'engine' => 'ConsoleLog'(.*?)'stream' => new ConsoleOutput\(\)(.*?)\)/s";
$debugReplace = "CakeLog::config('debug',$1'engine' => 'File'$2'file' => 'debug'$3)";

$errorPattern = "/CakeLog::config\('error',(.*?)'engine' => 'ConsoleLog'(.*?)'stream' => new ConsoleOutput\('php:\/\/stderr'\)(.*?)\)/s";
$errorReplace = "CakeLog::config('error',$1'engine' => 'File'$2'file' => 'error'$3)";

$pattenArr = [
    $debugPattern,
    $errorPattern
];

$replaceArr = [
    $debugReplace,
    $errorReplace
];


$configAfter = preg_replace($pattenArr, $replaceArr, $configBefore);
file_put_contents($file_path, $configAfter);
