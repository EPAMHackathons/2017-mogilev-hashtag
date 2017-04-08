<?php
require __DIR__ . '/../vendor/autoload.php';

use Ssh\Client;
use Ssh\Auth\PublicKey;


$auth = new PublicKey('wisewallet', '../keys/3_wisewallet.pub', '../keys/3_wisewallet.pri', '12341234');
$client = new Client('5.9.99.210');
$client->connect()->authenticate($auth);

$res = $client->exec('id');;
var_dump($res);


?>