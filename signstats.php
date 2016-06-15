<?php

    /**
     * Created by @TrK for http://post4vps.com
     * Source is available on http://github.com/DarkPowerInvador/MyBBstatssign
     * See http://php.net/manual/en/function.imagettftext.php to know about text on images using TTF/OTF Fonts.
     */

    if (!isset($_SERVER['HTTP_REFERER']))die('Direct access to file is not allowed'); //disallow users to not open the file by typing URL
    //-----------Start MyBB integration----------------
    define('IN_MYBB',1); //required don't change
    define('NO_ONLINE',1); //required don't change
    require_once './global.php'; //main file to read statstics
    $lang->load('stats'); //function to load stats variables
    $stats=$cache->read('stats'); //cache the stats values
    //------------End MyBB integration-----------------
    
    //----------Start Header section-------------------
    header('Pragma: public');
    header('Cache-Control: max-age=240');
    header('Expires: '. gmdate('D, d M Y H:i:s \G\M\T', time() + 240));
    if(isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])){ 
        header('Last-Modified: '.$_SERVER['HTTP_IF_MODIFIED_SINCE'],true,304); 
        exit; 
        } 
    header("Content-Type: image/png");
    //----------End Header section--------------------
    
    $bg = 'stats.png'; //background file
    $font = 'roung.otf'; //font file
    $forum = 'Post4VPS.com Free VPS Forum'; //forum name or description
    
    //------------------------------------------------------------------
    //PHP function to write text on image using font
    $img = imagecreatefrompng($bg);
    $fontcol = imagecolorallocate($img, 255, 255, 0);
    imagettftext($img,11,0,20,30,$fontcol,$font,utf8_decode($lang->members).' '.$stats['numusers']);
    imagettftext($img,11,0,144,30,$fontcol,$font,utf8_decode($lang->posts).' '.$stats['numposts']);
    imagettftext($img,11,0,271,30,$fontcol,$font,utf8_decode($lang->threads).' '.$stats['numthreads']);
    imagettftext($img,11,0,98,60,$fontcol,$font,$forum);
    imagepng($img);
    imagedestroy($img);

?>
