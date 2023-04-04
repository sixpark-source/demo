    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
        $scheme = "https://";
    }
    else{
        $scheme = "http://";
    }
    $url = $scheme.$_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    $urlAry = explode("/",$url);
    array_pop($urlAry);
    $tmpurl = implode("/",$urlAry)."/".$tmpurl;
