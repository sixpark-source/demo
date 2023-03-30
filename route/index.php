<?php
/*
* Copyright (C) 2015 xiuno.com
*/
!defined('DEBUG') and exit('Access Denied.');
// hook index_start.php
$page = param(1, 1);
$action = param(2, 'default');
if($action == 'app')
{
    $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
    if(strstr($agent,'iphone') || strstr($agent,'ipad')){
        header("location:https://apps.apple.com/us/app/%E6%89%8B%E6%9C%BA%E7%95%99%E5%9B%AD/id1474851292?l=zh&ls=1");
        exit;
    }
    else{
        header("location:https://play.google.com/store/apps/details?id=com.m6park.tt");
        exit;
    }
}
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
    $limit = 32;
    // hook index_start_followc_limit_end.php
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
    $limit = 32;
    // hook index_start_search_limit_end.php
    $offset = ($page - 1) * $limit;
    $pagination = pagination(url("index-{page}-search-".urlencode($keyword)), 300, $page, $limit);
    $apiHTTP = new \SixparkSource\Oauth2\HTTPRequest($auth_config);
    $dataPost = [
        'bbsid' => implode(',', $bbsIdAry),
        'keyword' => $keyword,
        'limit' => $limit,
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
    $limit = 32;
    // hook index_start_new_limit_end.php
    $offset = ($page - 1) * $limit;
    $pagination = pagination(url("index-{page}"), 2000, $page, $limit);
    $apiHTTP = new \SixparkSource\Oauth2\HTTPRequest($auth_config);
    $dataPost = [
        'bbsid' => implode(',', $bbsIdAry),
        'limit' => $limit,
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
    'limit' => 16
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