<?php
!defined('DEBUG') AND exit('Access Denied.');
// hook forum_start.php
$fid = param(1, 0);
$page = param(2, 1);
$orderby = param('orderby');
$extra = array(); // 给插件预留
$active = 'default';
!in_array($orderby, array('tid', 'lastpid')) AND $orderby = 'lastpid';
$extra['orderby'] = $orderby;
$forum = forum_read($fid);
empty($forum) AND message(3, lang('forum_not_exists'));
$pagesize = 50;
$offset = ($page - 1)*$pagesize;

$apiHTTP = new \SixparkSource\Oauth2\HTTPRequest($auth_config);
$dataPost = [
    'bbsid' => $fid,
    'limit' => $pagesize,
    'orderBy' => 'dateline',
    'offset' => $offset,
    'sort' => 'desc'
];
$threadListJson = $apiHTTP->postWithAuth($auth_config['resource_host']."/index.php?app=index&act=threadlist",$dataPost);
$threadList= json_decode($threadListJson,true);
$threadlist = $threadList['threadlist'];
$pagination = pagination(url("forum-$fid-{page}", $extra), 3000, $page, $pagesize);


$header['title'] = $forum['seo_title'] ? $forum['seo_title'] : $forum['name'].'-'.$conf['sitename'];
$header['mobile_title'] = $forum['name'];
$header['mobile_link'] = url("forum-$fid");
$header['keywords'] = '';
$_SESSION['fid'] = $fid;
// hook forum_end.php
include _include(APP_PATH.'view/htm/forum.htm');

?>