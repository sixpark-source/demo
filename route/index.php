<?php
/*
* Copyright (C) 2015 xiuno.com
*/
!defined('DEBUG') and exit('Access Denied.');
// hook index_start.php
$page = param(1, 1);
$action = param(2, 'default');
$order = $conf['order_default'];
$order != 'tid' and $order = 'lastpid';
$pagesize = $conf['pagesize'];
$active = 'default';
$bbsIdAry = [];
foreach ($forumlist_show as $item) {
    $bbsIdAry[] = $item['fid'];
}
if ($action == 'followc') {
    $active = 'followc';
    if($uid < 1)
    {
        header("Location:/?user-login.htm");
        exit;
    }
    $limit = 30;
    $offset = ($page - 1) * $limit;
    $pagination = pagination(url("index-{page}-followc"), 150, $page, $limit);
    $apiHTTP = new \SixparkSource\Oauth2\HTTPRequest($auth_config);
    $dataPost = [
        'token' => $user['token'],
        'limit' => $limit,
        'offset' => $offset,
    ];
    $threadListJson = $apiHTTP->postWithAuth($auth_config['resource_host'] . "/index.php?app=index&act=followc", $dataPost);
    $threadList = json_decode($threadListJson, true);
    $threadlist = $threadList['threadlist'];
    $followc_title = $threadList['title'];
}
else if($action == 'search'){
    $keyword = param('keyword','');
    if(empty($keyword))
    {
        $keyword = param(3);
    }
    if(empty($keyword))
    {
        message(-1, '搜索参数不能为空');
    }
    $limit = 30;
    $offset = ($page - 1) * $limit;
    $pagination = pagination(url("index-{page}-search-".urlencode($keyword)), 300, $page, $limit);
    $apiHTTP = new \SixparkSource\Oauth2\HTTPRequest($auth_config);
    $dataPost = [
        'bbsid' => implode(',', $bbsIdAry),
        'keyword' => $keyword,
        'limit' => 30,
        'orderBy' => 'dateline',
        'offset' => $offset,
        'sort' => 'desc'
    ];
    $threadListJson = $apiHTTP->postWithAuth($auth_config['resource_host'] . "/index.php?app=index&act=search", $dataPost);
    $threadList = json_decode($threadListJson, true);
    $threadlist = $threadList['threadlist'];
}
else {
    //最新帖子

    $limit = 30;
    $offset = ($page - 1) * $limit;
    $pagination = pagination(url("index-{page}"), 2000, $page, $limit);
    $apiHTTP = new \SixparkSource\Oauth2\HTTPRequest($auth_config);
    $dataPost = [
        'bbsid' => implode(',', $bbsIdAry),
        'limit' => 30,
        'orderBy' => 'dateline',
        'offset' => $offset,
        'sort' => 'desc'
    ];
    $threadListJson = $apiHTTP->postWithAuth($auth_config['resource_host'] . "/index.php?app=index&act=threadlist", $dataPost);
    $threadList = json_decode($threadListJson, true);
    $threadlist = $threadList['threadlist'];
}
//三天热评贴
$apiHTTP = new \SixparkSource\Oauth2\HTTPRequest($auth_config);
$dataPost = [
    'bbsid' => implode(',', $bbsIdAry),
    'limit' => 15
];
$hostListJson = $apiHTTP->postWithAuth($auth_config['resource_host'] . "/index.php?app=index&act=hotreply", $dataPost);
$hostListData = json_decode($hostListJson, true);
$hostList = $hostListData['threadlist'];
// SEO
$header['title'] = $conf['sitename'];                // site title
$header['keywords'] = '';                    // site keyword
$header['description'] = $conf['sitebrief'];            // site description
$_SESSION['fid'] = 0;
// hook index_end.php
include _include(APP_PATH . 'view/htm/index.htm');
?>