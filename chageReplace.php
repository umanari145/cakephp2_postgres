<?php

$file_path = __DIR__. "/app/Config/bootstrap.php";
$configBefore = file_get_contents($file_path);

$mode = $argv[1];


$debugToFilePattern = "/CakeLog::config\('debug',(.*?)'engine' => 'ConsoleLog'(.*?)'stream' => new ConsoleOutput\(\)(.*?)\)/s";
$debugToFileReplace = "CakeLog::config('debug',$1'engine' => 'File'$2'file' => 'debug'$3)";

$errorToFilePattern = "/CakeLog::config\('error',(.*?)'engine' => 'ConsoleLog'(.*?)'stream' => new ConsoleOutput\('php:\/\/stderr'\)(.*?)\)/s";
$errorToFileReplace = "CakeLog::config('error',$1'engine' => 'File'$2'file' => 'error'$3)";


$debugToStreamPattern = "/CakeLog::config\('debug',(.*?)'engine' => 'File'(.*?)'file' => 'debug'(.*?)\)/s";
$debugToStreamReplace = "CakeLog::config('debug',$1'engine' => 'ConsoleLog'$2'stream' => new ConsoleOutput()$3)";

$errorToStreamPattern = "/CakeLog::config\('error',(.*?)'engine' => 'File'(.*?)'file' => 'error'(.*?)\)/s";
$errorToStreamReplace = "CakeLog::config('error',$1'engine' => 'ConsoleLog'$2'stream' => new ConsoleOutput('php://stderr')$3)";


$pattenArr = [];
$replaceArr = [];

if ($mode === 'file') {
    $pattenArr[] = $debugToFilePattern;
    $pattenArr[] = $errorToFilePattern;
    $replaceArr[] = $debugToFileReplace;
    $replaceArr[] = $errorToFileReplace;    
} elseif ($mode == 'stream') {
    $pattenArr[] = $debugToStreamPattern;
    $pattenArr[] = $errorToStreamPattern;
    $replaceArr[] = $debugToStreamReplace;
    $replaceArr[] = $errorToStreamReplace;    

}


$configAfter = preg_replace($pattenArr, $replaceArr, $configBefore);
file_put_contents($file_path, $configAfter);
