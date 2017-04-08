<?php


class JobFactory {
    static function exec($jobId, $serverId, $credId, $payload = false) {
        echo "Serv = $serverId, cred = $credId, job = $jobId, payload = $payload\n";
        $types = db_getAll("SELECT * FROM job_types");
        $types = remap_array($types, 'id');


        $job = db_getRow("SELECT * FROM jobs WHERE id = $jobId");
        if (empty($job['active'])) return null;
        if (empty($types[$job['type']])) return null;


        switch ($types[$job['type']]['title']) {
            case 'SSH script':
            case 'SSH cmd':
                $className = 'SshJob';
                break;
            case 'Jenkins job':
                $className = 'JenkinsJob';
                break;
        }

        if (!empty($className)) {
            $obj = new $className($jobId, $serverId, $credId, $payload);
            return $obj->isOk ? $obj->exec() : "Error while initialising worker";
        }


        return null;
    }

    static function execJob($jobId, $server, $cmd) {
        list($login, $host) = explode('@', $server);
        $serverId = db_getOne("SELECT id FROM servers WHERE name = '$host' ");
        $cred = db_getOne("SELECT id FROM servers_credentials WHERE login = '$login' ");
        $job = db_getOne("SELECT id FROM jobs WHERE id = $jobId");

        return JobFactory::exec($job, $serverId, $cred, $cmd);

    }

}
?>