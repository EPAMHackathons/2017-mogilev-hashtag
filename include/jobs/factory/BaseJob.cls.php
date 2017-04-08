<?php


class BaseJob
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

        if (empty($this->server) || empty($this->job) || empty($this->creds) ) $this->isOk = false;
        if (empty($this->server['active']) || empty($this->creds['active']) || empty($this->job['active']) ) $this->isOk = false;

        if (empty($payload)) {
            $this->cmds = explode("\n", $this->job['command']);
        } else {
            $this->cmds = [$payload];
        }

    }



}

?>