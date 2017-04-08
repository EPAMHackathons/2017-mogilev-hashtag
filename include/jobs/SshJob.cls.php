<?php
use Ssh\Client;
use Ssh\Auth\Password;
use Ssh\Auth\PublicKey;


class SshJob extends BaseJob
{
    public $isOk = true;

    function __construct($jobId, $serverId, $credId, $payload = false)
    {
        $this->jobId = $jobId;
        $this->serverId = $serverId;
        $this->credId = $credId;

        $this->server = db_getRow("SELECT * FROM servers WHERE id = " . $this->serverId);
        $this->job = db_getRow("SELECT * FROM jobs WHERE id = " . $this->jobId);
        $this->creds = db_getRow("SELECT * FROM servers_credentials WHERE id = " . $this->credId);

        if (empty($payload)) {
            $this->cmds = explode("\n", $this->job['command']);
        } else {
            $this->cmds = [$payload];
        }


    }

    function exec()
    {
        try {
            if($this->creds['password']){
                $auth = new Password($this->creds['login'], $this->creds['password']);
            } elseif ($this->creds['public_key']) {
                $auth = new PublicKey($this->creds['login'], '/keys/'.$this->creds['public_key'], '/keys/'.$this->creds['private_key'], $this->creds['key_password']);
            }

            $client = new Client($this->server['ip']);
            $client->connect()->authenticate($auth);
        } catch (RuntimeException $e) {
            print_r($e);
            return "Error while initialising connection: " . $e->getMessage();
        }


        $ret = [];
        foreach ($this->cmds as $cmd) {
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