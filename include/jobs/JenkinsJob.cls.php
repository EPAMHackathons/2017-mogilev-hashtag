<?php

class JenkinsJob extends BaseJob {

    function exec()
    {
        $url = $this->server['ip'].'/job/'.trim($this->cmds[0]).'/build';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:') );
        curl_setopt($ch, CURLOPT_USERPWD, $this->creds['login'] . ":" . $this->creds['password']);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
        $return = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);

        print_r($info);
        var_dump($return);

        if (empty($return) && $info['http_code'] == '201') {
            return "Ok, build scheduled";
        } else {
            return "Error while triggering build";
        }

    }
}

?>