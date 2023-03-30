<?php
!defined('DEBUG') and exit('Access Denied.');
// hook forum_start.php
$fid = param(1, 0);
$page = param(2, 1);
$orderby = param('orderby');
$extra = array(); // 给插件预留
$active = 'default';
!in_array($orderby, array('tid', 'lastpid')) and $orderby = 'lastpid';
$extra['orderby'] = $orderby;
$tag = param('tag', '');
if ($fid < 1) {
    $fid = key($forumlist_show);
}
$forum = forum_read($fid);
empty($forum) and message(3, lang('forum_not_exists'));
$apiHTTP = new \SixparkSource\Oauth2\HTTPRequest($auth_config);
if (!empty($tag)) {
    $pagesize = 32;
    $dataPost = [
        'bbsid' => $fid,
        'tag' => $tag,
        'limit' => $pagesize
    ];
    $threadListJson = $apiHTTP->postWithAuth($auth_config['resource_host'] . "/index.php?app=index&act=tagthread", $dataPost);
    $threadList = json_decode($threadListJson, true);
    $threadlist = $threadList['threadlist'];
} else if (param('digest', '0') == 1) {
    $active = 'digest';
    $pagesize = 32;
    $dataPost = [
        'bbsid' => $fid,
        'limit' => $pagesize
    ];
    $threadListJson = $apiHTTP->postWithAuth($auth_config['resource_host'] . "/index.php?app=index&act=goldthread", $dataPost);
    $threadList = json_decode($threadListJson, true);
    $threadlist = $threadList['threadlist'];
    $pagination = '';
} else {
    $pagesize = 32;
    $offset = ($page - 1) * $pagesize;
    $dataPost = [
        'bbsid' => $fid,
        'limit' => $pagesize,
        'orderBy' => 'dateline',
        'offset' => $offset,
        'sort' => 'desc'
    ];
    $threadListJson = $apiHTTP->postWithAuth($auth_config['resource_host'] . "/index.php?app=index&act=threadlist", $dataPost);
    $threadList = json_decode($threadListJson, true);
    $threadlist = $threadList['threadlist'];
    $pagination = pagination(url("forum-$fid-{page}", $extra), 3000, $page, $pagesize);
}
$header['title'] = $forum['seo_title'] ? $forum['seo_title'] : $forum['name'] . '-' . $conf['sitename'];
$header['mobile_title'] = $forum['name'];
$header['mobile_link'] = url("forum-$fid");
$header['keywords'] = '';
$_SESSION['fid'] = $fid;
// hook forum_end.php
//板块信息
$dataPost = [
    'bbsid' => $fid
];
$bbsJson = $apiHTTP->postWithAuth($auth_config['resource_host'] . "/index.php?app=pub&act=showbbs", $dataPost);
$bbsInfo = json_decode($bbsJson, true);
//栏目72小时热帖
$dataPost = [
    'bbsid' => $fid,
    'limit' => 16,
];
$hotViewJson = $apiHTTP->postWithAuth($auth_config['resource_host'] . "/index.php?app=index&act=hotview", $dataPost);
$hotViewList = json_decode($hotViewJson, true);
$hotview = $hotViewList['threadlist'];

//三天热评贴
$dataPost = [
    'bbsid' => $fid,
    'limit' => 16
];
$hostListJson = $apiHTTP->postWithAuth($auth_config['resource_host'] . "/index.php?app=index&act=hotreply", $dataPost);
$hostListData = json_decode($hostListJson, true);
$hostList = $hostListData['threadlist'];
// hook forum_end.php
include _include(APP_PATH . 'view/htm/forum.htm');
?>