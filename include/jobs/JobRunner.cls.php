<?php
use Ssh\Client;
use Ssh\Auth\Password;


class JobRunner
{
    public $isOk = true;

    function __construct($jobId, $serverId, $credId)
    {
        $this->jobId = $jobId;
        $this->serverId = $serverId;
        $this->credId = $credId;

        $this->server = db_getRow("SELECT * FROM servers WHERE id = " . $this->serverId);
        $this->job = db_getRow("SELECT * FROM jobs WHERE id = " . $this->jobId);
        $this->creds = db_getRow("SELECT * FROM servers_credentials WHERE id = " . $this->credId);

    }

    function exec()
    {
        try {
            $auth = new Password($this->creds['login'], $this->creds['password']);
            $client = new Client($this->server['ip']);
            $client->connect()->authenticate($auth);
        } catch (RuntimeException $e) {
            print_r($e);
            return "Error while initialising connection: " . $e->getMessage();
        }


        $cmds = explode("\n", $this->job['command']);
        $ret = [];
        foreach ($cmds as $cmd) {
            $cmd = trim($cmd);
            $ret[] = 'cmd> ' . $cmd;
            $res = $client->exec($cmd);;
            $ret[] = $res;
        }

        $res = implode("\n", $ret);
        return $res;
    }
}

?>