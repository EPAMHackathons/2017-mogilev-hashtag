<?php
require 'vendor/autoload.php';
require_once ('include/init.inc.php');


curl -X POST http://148.251.120.12:8888/job/ulmart-podarki/build --user orbytale:d4d6ee3b1d95fcf5565b9468d44da98c

die;
$jobId = 3;
$serverId = 3;
$credId = 2;

$job = JobFactory::exec($jobId, $serverId, $credId);
var_dump($job);

?>