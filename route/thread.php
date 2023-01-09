<?php

!defined('DEBUG') AND exit('Access Denied.');

$action = param(1);

// hook thread_start.php

// 发表主题帖 | create new thread
if($action == 'create') {
	
	// hook thread_create_get_post.php
		
	user_login_check();

	if($method == 'GET') {
		
		// hook thread_create_get_start.php
		
		$fid = param(2, 0);
		$forum = $fid ? forum_read($fid) : array();
		
		$forumlist_allowthread = forum_list_access_filter($forumlist, $gid, 'allowthread');
		$forumarr = xn_json_encode(arrlist_key_values($forumlist_allowthread, 'fid', 'name'));
		if(empty($forumlist_allowthread)) {
			message(-1, lang('user_group_insufficient_privilege'));
		}
		
		$header['title'] = lang('create_thread');
		$header['mobile_title'] = $fid ? $forum['name'] : '';
		$header['mobile_linke'] = url("forum-$fid");
		
		// hook thread_create_get_end.php
		
		include _include(APP_PATH.'view/htm/post.htm');
		
	} else {
		
		// hook thread_create_thread_start.php
		
		$fid = param('fid', 0);
		$forum = forum_read($fid);
        if(empty($user) || $user['expires']<time())
        {
            message(0, "请重新登录后再次尝试");
        }
		$subject = param('subject');
		empty($subject) AND message('subject', lang('please_input_subject'));
		xn_strlen($subject) > 128 AND message('subject', lang('subject_length_over_limit', array('maxlength'=>128)));
		$message = param('message', '', FALSE);
		empty($message) AND message('message', lang('please_input_message'));
        //发布帖子
        $postData = [
            'bbsid' => $fid,
            'token' => $user['token'],
            'subject' => $subject,
            'content' => $message
        ];
        $apiHTTP = new \SixparkSource\Oauth2\HTTPRequest($auth_config);
        $postJson = $apiHTTP->postWithAuth($auth_config['resource_host']."/index.php?app=index&act=dopost",$postData);
        $post = json_decode($postJson,true);
        if($post['status'] == 2301)
        {
            message(0, lang('create_thread_sucessfully'));
        }
        else{
            message(0, "发布失败");
        }
	}
	
// 帖子详情 | post detail
} else {
	
	// thread-{tid}-{page}-{keyword}.htm
	$tid = param(1, 0);
	$page = param(2, 1);
	$keyword = param(3);
	$pagesize = $conf['postlist_pagesize'];
	//$pagesize = 10;
	//$page == 1 AND $pagesize++;
	$thread = thread_read($tid);
	$fid = $thread['bbsid'];
	$forum = forum_read($fid);
    $thread['user'] = [
        'uid' => $thread['authorid'],
        'username' => $thread['src'],
        'threads' => 0,
    ];

	
	$postlist = post_find_by_tid($tid, $page, $pagesize);
	$keywordurl = '';
	if($keyword) {
		$thread['title'] = post_highlight_keyword($thread['title'], $keyword);
		//$first['message'] = post_highlight_keyword($first['subject']);
		$keywordurl = "-$keyword";
	}
	
	$header['title'] = $thread['title'].'-'.$forum['name'].'-'.$conf['sitename']; 
	//$header['mobile_title'] = lang('thread_detail');
	$header['mobile_title'] = $forum['name'];;
	$header['mobile_link'] = url("forum-$fid");
	$header['keywords'] = ''; 
	$header['description'] = $thread['title'];
	$_SESSION['fid'] = $fid;
	
	
	
	// hook thread_info_end.php
	
	include _include(APP_PATH.'view/htm/thread.htm');
}

// hook thread_end.php

?>