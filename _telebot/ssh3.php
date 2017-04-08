<?php
use Ssh\Client;
use Ssh\Auth\Password;

$auth = new Password($this->creds['login'], $this->creds['password']);
$client = new Client($this->server['ip']);
$client->connect()->authenticate($auth);

$res = $client->exec('id');;
var_dump($res);


?>