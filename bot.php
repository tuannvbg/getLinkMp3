<?php
require_once __DIR__. DIRECTORY_SEPARATOR. 'vendor/autoload.php';
require_once __DIR__.'/getlink.php';

use juno_okyo\Chatfuel;

//if (isset($_GET['msg']) && ! empty($_GET['msg']))
//{
//    (new Chatfuel())->sendText($_GET['msg']);
//}
//nhận URL từ user
$mp3Link=$_GET['msg'];
//$mp3Link='http://mp3.zing.vn/bai-hat/1234-Chi-Dan/ZW7FE0FC.html';
$getLink = new getLink();
//Lấy link api
$apiLink = $getLink->mp3Link($mp3Link);
//Lấy link lossless
$jsonLink = $getLink->curlLink($apiLink);
$mp3=$getLink->getLink320($jsonLink);

$flac=$getLink->getLinkLossless($jsonLink);

if ($jsonLink=='Incorrect URL!')
{
    (new Chatfuel())->sendText('Link bạn nhập không khả dụng!');
}else {
    (new Chatfuel())->sendText('Bôi đen và copy link, không nhấn trực tiếp: '.$mp3);
}

?>