<?php
/*
* Copyright (C) 2015 xiuno.com
*/
!defined('DEBUG') and exit('Access Denied.');
// hook index_start.php
$page = param(1, 1);
$order = $conf['order_default'];
$order != 'tid' and $order = 'lastpid';
$pagesize = $conf['pagesize'];
$active = 'default';
// 从默认的地方读取主题列表
//最新帖子
$bbsIdAry = [];
foreach($forumlist_show as $item)
{
    $bbsIdAry[] = $item['fid'];
}
$limit = 30;
$offset = ($page - 1)*$limit;
$pagination = pagination(url("index-{page}"), 2000, $page, $pagesize);
$apiHTTP = new \SixparkSource\Oauth2\HTTPRequest($auth_config);
$dataPost = [
    'bbsid' => implode(',',$bbsIdAry),
    'limit' => 30,
    'orderBy' => 'dateline',
    'offset' => $offset,
    'sort' => 'desc'
];
$threadListJson = $apiHTTP->postWithAuth($auth_config['resource_host']."/index.php?app=index&act=threadlist",$dataPost);
$threadList= json_decode($threadListJson,true);
$threadlist = $threadList['threadlist'];
// SEO
$header['title'] = $conf['sitename'];                // site title
$header['keywords'] = '';                    // site keyword
$header['description'] = $conf['sitebrief'];            // site description
$_SESSION['fid'] = 0;
// hook index_end.php
include _include(APP_PATH . 'view/htm/index.htm');
?>