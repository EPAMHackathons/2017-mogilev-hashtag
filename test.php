<?php
require 'vendor/autoload.php';
require_once ('include/init.inc.php');


$jobId = 3;
$serverId = 3;
$credId = 2;

$job = JobFactory::exec($jobId, $serverId, $credId);
var_dump($job);

?>