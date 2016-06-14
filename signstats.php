<?php

    /**
     * Created by @TrK for http://post4vps.com
     * Source is available on http://github.com/DarkPowerInvador/MyBBstatssign
     * See http://php.net/manual/en/function.imagettftext.php to know about text on images using TTF/OTF Fonts.
     */

    if (!isset($_SERVER['HTTP_REFERER']))die('Direct access to file is not allowed');
    define('IN_MYBB',1);
    define('NO_ONLINE',1);
    require_once './global.php';
    $lang->load('stats');
    $stats=$cache->read('stats');
    header('Pragma: public');
    header('Cache-Control: max-age=240');
    header('Expires: '. gmdate('D, d M Y H:i:s \G\M\T', time() + 240));
    if(isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])){ 
        header('Last-Modified: '.$_SERVER['HTTP_IF_MODIFIED_SINCE'],true,304); 
        exit; 
        } 
    header("Content-Type: image/png");
    $bg = 'stats.png';
    $font = 'roung.otf';
    $forum = 'Post4VPS.com Free VPS Forum';

    $img = imagecreatefrompng($bg);
    $fontcol = imagecolorallocate($img, 255, 255, 0);
    imagettftext($img,11,0,20,30,$fontcol,$font,utf8_decode($lang->members).' '.$stats['numusers']);
    imagettftext($img,11,0,144,30,$fontcol,$font,utf8_decode($lang->posts).' '.$stats['numposts']);
    imagettftext($img,11,0,271,30,$fontcol,$font,utf8_decode($lang->threads).' '.$stats['numthreads']);
    imagettftext($img,11,0,98,60,$fontcol,$font,$forum);
    imagepng($img);
    imagedestroy($img);

?>
