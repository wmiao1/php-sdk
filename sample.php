<?php

//require('./vendor/autoload.php');

require('./include.php');

use Tencentyun\Image;
use Tencentyun\Auth;

// 上传
$uploadRet = Image::upload('/tmp/amazon.jpg');
if (0 === $uploadRet['code']) {
    $fileid = $uploadRet['data']['fileid'];

    // 查询管理信息
    $statRet = Image::stat($fileid);
    var_dump($statRet);

    // 复制
    $copyRet = Image::copy($fileid);
    var_dump($copyRet);

    // 生成私密下载url
    $downloadUrl = $copyRet['data']['downloadUrl'];
    $sign = Auth::appSign($downloadUrl, 0);
    $signedUrl = $downloadUrl . '?sign=' . $sign;
    var_dump($signedUrl);

    //生成新的上传签名
    $expired = time() + 999;
    $sign = Auth::appSign('http://web.image.myqcloud.com/photos/v1/200679/0/', $expired);
    var_dump($sign);

    $delRet = Image::del($fileid);
    var_dump($delRet);
} else {
    var_dump($uploadRet);
}






//end of script