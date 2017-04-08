<?php
use Ssh\Client;
use Ssh\Auth\Password;
use Ssh\Auth\PublicKey;


class SshJob extends BaseJob
{


    function exec()
    {
        try {
            if ($this->creds['password']) {
                $auth = new Password($this->creds['login'], $this->creds['password']);
            } elseif ($this->creds['public_key']) {
                $auth = new PublicKey($this->creds['login'], DOC_ROOT . '/keys/' . $this->creds['public_key'], DOC_ROOT . '/keys/' . $this->creds['private_key'], $this->creds['key_password']);
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