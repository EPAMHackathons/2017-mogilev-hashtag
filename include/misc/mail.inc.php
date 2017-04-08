<?
function my_sendmail($to, $subj, $text, $attachments = array(), $isHtml = false)
{

    $conf = $_SERVER['serv_config']['smtp'];

    $mail = new htmlMimeMail();
    $mail->setSubject($subj);
    if ($isHtml) {
        $mail->setHTML($text, strip_tags($text));
    } else {
        $mail->setText($text);
    }
    $mail->setHeadCharset('UTF-8');
    $mail->setHtmlCharset('UTF-8');
    $mail->setTextCharset('UTF-8');

    if (!is_array($to)) $to = array($to);

    if (!empty($attachments)) {
        foreach ($attachments as $at) {
            $attachment = $mail->getFile($at);
            $mail->addAttachment($attachment, basename($at), mime_content_type($at));
        }

    }

    $mail->setFrom($conf['from']);
    if (!empty($conf['pass'])) {
        $mail->setSMTPParams($conf['host'], $conf['port'], $conf['user'], $conf['pass'], true);
    } else {
        $mail->setSMTPParams($conf['host'], $conf['port'], $conf['user']);
    }

    $res = $mail->send($to, 'smtp');
    if (!$res && is_dev_server()) {
        //   print_r($mail->errors);
    }

    return $res;
}

function send_email_tpl($to, $subj, $tpl_name, $data, $attachments = array())
{
    load_smarty();
    $tpl = new Page();
    foreach ($data as $k => $v) $tpl->assign($k, $v);

    $text = $tpl->fetch('emails/' . $tpl_name . '.tpl');

    return my_sendmail($to, $subj, $text, $attachments, true);
}

?>