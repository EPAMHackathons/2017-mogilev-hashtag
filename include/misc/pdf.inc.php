<?php

function genPdf($fileIn, $pdfOut)
{
    $wkbin = (is_dev_server()) ? '/usr/local/bin/wkhtmltopdf ' : 'xvfb-run -a wkhtmltopdf ';

    //$pdfOut = preg_replace('@\w+\.pdf@', 'out.pdf', $pdfOut);    var_dump($pdfOut);

    $cmd = $wkbin . "  --quiet --dpi 1200 --image-dpi 2400 --enable-external-links -T 0 -R 0 -B 0 -L 0 --orientation Portrait --disable-smart-shrinking  --page-width 201.2 --page-height 279.5  $fileIn $pdfOut >/dev/null 2>/tmp/pdfErr";
    //var_dump($cmd);
    passthru($cmd);
}

?>