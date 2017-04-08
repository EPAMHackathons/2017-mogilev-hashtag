<?php
require __DIR__ . '/../vendor/autoload.php';


use Ssh\Client;
use Ssh\Auth\Password;
use Ssh\Shell;

$auth = new Password('alex', 'xcsPhtOAGLlLrzdn');
$client = new Client('148.251.120.12');

/*error_reporting(E_ALL);
var_dump($auth);
$client->connect()->authenticate($auth);
echo $client->exec('top | ');
echo $client->exec('grep 1');
*/

/*

try {
    $client->connect()->authenticate($auth);
    echo $client
        ->chain()
        ->exec('pgrep node', function (Result $result, Chain $chain) {
            $result = $result->getResult();
            if ($result && is_numeric($result)) {
                $chain->stopChain();
            }
        })
        ->exec('/usr/local/bin/node ~/server.js > ~/node_server.log &');
} catch (\RuntimeException $e) {
    echo $e->getMessage();
}
*/
$client->connect()->authenticate($auth);
$shell = new Shell($client);

while (true) {
    $cmd = readline("> ");
    $res = $shell->exec($cmd);
    echo $res."\n";
    usleep(100);
}
?>