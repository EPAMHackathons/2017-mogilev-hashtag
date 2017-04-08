<?
function resize_im($dir, $fname)
{
    $res = false;

    $im = imagecreatefromstring(file_get_contents(DOC_ROOT . $dir . '/' . $fname));
    if (!$im) return false;

    $w = $imw = imagesx($im);
    $h = $imh = imagesy($im);
    $th_w = $w;
    $th_h = $h;
    $move_w = $move_h = 0;

    $img_maxsize = 300;
    $th_w = $img_maxsize;
    $th_h = round($th_w * ($imh / $imw));

    $resized = imageCreatetruecolor($th_w, $th_h);
    $created = fastimagecopyresampled($resized, $im, 0, 0, 0, 0, $th_w, $th_h, $imw, $imh);


    //Grab new image
    $res = imagejpeg($resized, DOC_ROOT . $dir . '/th-' . $fname, 80);
    return $res;
}

function fastimagecopyresampled(&$dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h, $quality = 3)
{
    // Plug-and-Play fastimagecopyresampled function replaces much slower imagecopyresampled.
    // Just include this function and change all "imagecopyresampled" references to "fastimagecopyresampled".
    // Typically from 30 to 60 times faster when reducing high resolution images down to thumbnail size using the default quality setting.
    // Author: Tim Eckel - Date: 12/17/04 - Project: FreeRingers.net - Freely distributable.
    //
    // Optional "quality" parameter (defaults is 3).  Fractional values are allowed, for example 1.5.
    // 1 = Up to 600 times faster.  Poor results, just uses imagecopyresized but removes black edges.
    // 2 = Up to 95 times faster.  Images may appear too sharp, some people may prefer it.
    // 3 = Up to 60 times faster.  Will give high quality smooth results very close to imagecopyresampled.
    // 4 = Up to 25 times faster.  Almost identical to imagecopyresampled for most images.
    // 5 = No speedup.  Just uses imagecopyresampled, highest quality but no advantage over imagecopyresampled.

    if (empty($src_image) || empty($dst_image)) {
        return false;
    }
    if ($quality <= 1) {
        $temp = imagecreatetruecolor($dst_w + 1, $dst_h + 1);
        imagecopyresized($temp, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w + 1, $dst_h + 1, $src_w, $src_h);
        imagecopyresized($dst_image, $temp, 0, 0, 0, 0, $dst_w, $dst_h, $dst_w, $dst_h);
        imagedestroy($temp);
    } elseif ($quality < 5 && (($dst_w * $quality) < $src_w || ($dst_h * $quality) < $src_h)) {
        $tmp_w = $dst_w * $quality;
        $tmp_h = $dst_h * $quality;
        $temp = imagecreatetruecolor($tmp_w + 1, $tmp_h + 1);
        imagecopyresized($temp, $src_image, $dst_x * $quality, $dst_y * $quality, $src_x, $src_y, $tmp_w + 1, $tmp_h + 1, $src_w, $src_h);
        imagecopyresampled($dst_image, $temp, 0, 0, 0, 0, $dst_w, $dst_h, $tmp_w, $tmp_h);
        imagedestroy($temp);
    } else {
        imagecopyresampled($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
    }
    return true;
}


function get_im_size($fname) {
    $res = array('w' => 0, 'h' => 0);

    $im = imagecreatefromstring( file_get_contents($fname) );
    if (!$im) return false;

    $res['w'] = imagesx($im);
    $res['h'] = imagesy($im);

    return $res;
}
?>