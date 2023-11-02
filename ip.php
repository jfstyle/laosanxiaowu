

<?php

function getClientIP(){
    //getenv()函数定义：取得系统的环境变量
    if (getenv("HTTP_CLIENT_IP")) {
        $ip = getenv("HTTP_CLIENT_IP");
    } elseif (getenv("HTTP_X_FORWARDED_FOR")) {
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    } elseif (getenv("REMOTE_ADDR")) {
        $ip = getenv("REMOTE_ADDR");
    } else {
        $ip = "Unknow";
    }
    if ($ip == '::1'){
        //本地
        $ip = '127.0.0.1';
    }
    return $ip;
}

/**
 * 获取服务端IP
 * @return array|false|mixed|string
 */
function getServerIp(){
    $server_ip = gethostbyname($_SERVER["SERVER_NAME"]);
    return $server_ip;
}

function getServerIptwo()
{
    if (isset($_SERVER)) {
        if ($_SERVER['SERVER_ADDR']) {
            $server_ip = $_SERVER['SERVER_ADDR'];
        } else {
            $server_ip = $_SERVER['LOCAL_ADDR'];
        }
    } else {
        $server_ip = getenv('SERVER_ADDR');
    }
    if ($server_ip == '::1') {
        //本地
        $server_ip = '127.0.0.1';
    }
    return $server_ip;
}
exit(getClientIP().',serverIp:'.getServerIp().',serverIptwo:'.getServerIptwo());

?>