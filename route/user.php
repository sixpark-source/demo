<?php

!defined('DEBUG') and exit('Access Denied.');

include _include(XIUNOPHP_PATH . 'xn_send_mail.func.php');

$action = param(1);

is_numeric($action) and $action = '';

// hook user_start.php

if (empty($action)) {

    // hook user_index_start.php

    $_uid = param(1, 0);
    empty($_uid) and $_uid = $uid;
    $_user = user_read_api($_uid);

    empty($_user) and message(-1, lang('user_not_exists'));

    $header['title'] = $_user['username'];
    $header['mobile_title'] = $_user['username'];
    $isSelf = 0;
    if (!empty($uid)) {
        if ($uid == $_uid) {
            $isSelf = 1;
        } else {
            $isFollow = 0;
            $isBlack = 0;
            $loginUser = user_read_api($uid);
            foreach ($loginUser['follow_list'] as $item) {
                if ($_uid == $item['uid']) {
                    $isFollow = 1;
                    break;
                }
            }

            foreach ($loginUser['black_list'] as $item) {
                if ($_uid == $item['uid']) {
                    $isBlack = 1;
                    $isFollow = 0;
                    break;
                }
            }
        }
    }
    // hook user_index_end.php

    include _include(APP_PATH . 'view/htm/user.htm');

} elseif ($action == 'thread') {

    // hook user_thread_start.php

    $_uid = param(2, 0);
    empty($_uid) and $_uid = $uid;
    $_user = user_read_api($_uid);
    empty($_user) and message(-1, lang('user_not_exists'));
    $header['title'] = $_user['username'];
    $header['mobile_title'] = $_user['username'];

    $page = param(3, 1);

    $apiHTTP = new \SixparkSource\Oauth2\HTTPRequest($auth_config);
    //楼主前期帖子
    $bbsIdAry = [];
    foreach ($forumlist_show as $item) {
        $bbsIdAry[] = $item['fid'];
    }
    $limit = 30;
    $offset = ($page - 1) * $limit;
    $dataPost = [
        'uid' => $_uid,
        'bbsid' => implode(',', $bbsIdAry),
        'offset' => $offset,
        'limit' => $limit,
    ];
    $userThreadJson = $apiHTTP->postWithAuth($auth_config['resource_host'] . "/index.php?app=index&act=userthread", $dataPost);
    $userThreadData = json_decode($userThreadJson, true);

    $threadlist = $userThreadData['threadlist'];
    $totalnum = 300;
    $pagination = pagination(url("user-thread-$_uid-{page}"), 300, $page, $limit);
    // hook user_thread_end.php

    include _include(APP_PATH . 'view/htm/user_thread.htm');

} elseif ($action == 'adminlogin') {

	if ($method == 'GET') {
		// hook user_login_get_start.php

		$referer = user_http_referer();

		$header['title'] = lang('user_login');

		// hook user_login_get_end.php

		include _include(APP_PATH . 'view/htm/user_login.htm');

	} else if ($method == 'POST') {


		// hook user_login_post_start.php

		$email = param('email');            // 邮箱或者手机号 / email or mobile
		$password = param('password');
		empty($email) and message('email', lang('email_is_empty'));
		if (is_email($email, $err)) {
			$_user = user_read_by_email($email);
			empty($_user) and message('email', lang('email_not_exists'));
		} else {
			$_user = user_read_by_username($email);
			empty($_user) and message('email', lang('username_not_exists'));
		}

		!is_password($password, $err) and message('password', $err);
		$check = (md5($password . $_user['salt']) == $_user['password']);
		// hook user_login_post_password_check_after.php
		!$check and message('password', lang('password_incorrect'));

		// 更新登录时间和次数
		// update login times
		user_update($_user['uid'], array('login_ip' => $longip, 'login_date' => $time, 'logins+' => 1));

		// 全局变量 $uid 会在结束后，在函数 register_shutdown_function() 中存入 session (文件: model/session.func.php)
		// global variable $uid will save to session in register_shutdown_function() (file: model/session.func.php)
		$uid = $_user['uid'];

		$_SESSION['uid'] = $uid;

		user_token_set($_user['uid']);

		// hook user_login_post_end.php

		// 设置 token，下次自动登陆。

		message(0, lang('user_login_successfully'));

	}

} elseif ($action == 'login') {
    $auth_config = @include APP_PATH . 'conf/conf.auth.php';
//用户授权
    $authorizeHostAry = parse_url($auth_config['authorize_route']);
    if (empty($authorizeHostAry['query'])) {
        $authorizeUrl = $auth_config['authorize_route'] . "?response_type=code&client_id=" . $auth_config['client_id'] . "&state=abc";
    } else {
        $authorizeUrl = $auth_config['authorize_route'] . "&response_type=code&client_id=" . $auth_config['client_id'] . "&state=abc";
    }
    header("Location:" . $authorizeUrl);
    exit;
    // hook user_login_get_post.php
} elseif ($action == 'create') {

    // hook user_create_get_post.php

    empty($conf['user_create_on']) and message(-1, lang('user_create_not_on'));

    if ($method == 'GET') {

        // hook user_create_get_start.php

        $referer = user_http_referer();
        $header['title'] = lang('create_user');

        // hook user_create_get_end.php

        include _include(APP_PATH . 'view/htm/user_create.htm');

    } else if ($method == 'POST') {

        // hook user_create_post_start.php

        $email = param('email');
        $username = param('username');
        $password = param('password');
        $code = param('code');
        empty($email) and message('email', lang('please_input_email'));
        empty($username) and message('username', lang('please_input_username'));
        empty($password) and message('password', lang('please_input_password'));

        if ($conf['user_create_email_on']) {
            $sess_email = _SESSION('user_create_email');
            $sess_code = _SESSION('user_create_code');
            empty($sess_code) and message('code', lang('click_to_get_verify_code'));
            empty($sess_email) and message('code', lang('click_to_get_verify_code'));
            $email != $sess_email and message('code', lang('verify_code_incorrect'));
            $code != $sess_code and message('code', lang('verify_code_incorrect'));
        }

        !is_email($email, $err) and message('email', $err);
        $_user = user_read_by_email($email);
        $_user and message('email', lang('email_is_in_use'));

        !is_username($username, $err) and message('username', $err);
        $_user = user_read_by_username($username);
        $_user and message('username', lang('username_is_in_use'));

        !is_password($password, $err) and message('password', $err);

        $salt = xn_rand(16);
        $pwd = md5($password . $salt);
        $gid = 101;
        $_user = array(
            'username' => $username,
            'email' => $email,
            'password' => $pwd,
            'salt' => $salt,
            'gid' => $gid,
            'create_ip' => $longip,
            'create_date' => $time,
            'logins' => 1,
            'login_date' => $time,
            'login_ip' => $longip,
        );
        $uid = user_create($_user);
        $uid === FALSE and message('email', lang('user_create_failed'));
        $user = user_read($uid);

        // 更新 session

        unset($_SESSION['user_create_email']);
        unset($_SESSION['user_create_code']);
        $_SESSION['uid'] = $uid;
        user_token_set($uid);

        $extra = array('token' => user_token_gen($uid));

        // hook user_create_post_end.php

        message(0, lang('user_create_sucessfully'), $extra);
    }

} elseif ($action == 'logout') {

    // hook user_logout_start.php

    $uid = 0;
    $_SESSION['uid'] = $uid;
    user_token_clear();

    // hook user_logout_end.php

    message(0, jump(lang('logout_successfully'), http_referer(), 1));
    //message(0, jump('退出成功', './', 1));

// 重设密码第 1 步 | reset password first step
} elseif ($action == 'resetpw') {

    // hook user_resetpw_get_post.php

    !$conf['user_resetpw_on'] and message(-1, '未开启密码找回功能！');

    if ($method == 'GET') {

        // hook user_resetpw_get_start.php

        $header['title'] = lang('resetpw');

        // hook user_resetpw_get_end.php

        include _include(APP_PATH . 'view/htm/user_resetpw.htm');

    } else if ($method == 'POST') {

        // hook user_resetpw_post_start.php

        $email = param('email');
        empty($email) and message('email', lang('please_input_email'));
        !is_email($email, $err) and message('email', $err);

        $_user = user_read_by_email($email);
        !$_user and message('email', lang('email_is_not_in_use'));

        $code = param('code');
        empty($code) and message('code', lang('please_input_verify_code'));

        $sess_email = _SESSION('user_resetpw_email');
        $sess_code = _SESSION('user_resetpw_code');
        empty($sess_code) and message('code', lang('click_to_get_verify_code'));
        empty($sess_email) and message('code', lang('click_to_get_verify_code'));
        $email != $sess_email and message('code', lang('verify_code_incorrect'));
        $code != $sess_code and message('code', lang('verify_code_incorrect'));

        $_SESSION['resetpw_verify_email'] = $sess_email;

        // hook user_resetpw_post_end.php

        message(0, lang('check_ok_to_next_step'));
    }

// 重设密码第 3 步 | reset password step 3
} elseif ($action == 'resetpw_complete') {

    // hook user_resetpw_get_post.php

    // 校验数据
    $email = _SESSION('user_resetpw_email');
    $resetpw_verify_email = _SESSION('resetpw_verify_email');
    (empty($email) || empty($resetpw_verify_email)) and message(-1, lang('data_empty_to_last_step'));

    ($resetpw_verify_email != $email) and message(-1, lang('data_empty_to_last_step'));

    $_user = user_read_by_email($email);
    empty($_user) and message(-1, lang('email_not_exists'));
    $_uid = $_user['uid'];

    if ($method == 'GET') {

        // hook user_resetpw_get_start.php

        $header['title'] = lang('resetpw');

        // hook user_resetpw_get_end.php

        include _include(APP_PATH . 'view/htm/user_resetpw_complete.htm');

    } else if ($method == 'POST') {

        // hook user_resetpw_post_start.php

        $password = param('password');
        empty($password) and message('password', lang('please_input_password'));

        $salt = $_user['salt'];
        $password = md5($password . $salt);

        !is_password($password, $err) and message('password', $err);
        user_update($_uid, array('password' => $password));

        unset($_SESSION['user_resetpw_email']);
        unset($_SESSION['user_resetpw_code']);
        unset($_SESSION['resetpw_verify_ok']);

        // hook user_resetpw_post_end.php

        message(0, lang('modify_successfully'));

    }

// 发送验证码
} elseif ($action == 'send_code') {

    $method != 'POST' and message(-1, lang('method_error'));

    // hook user_sendcode_start.php

    $action2 = param(2);

    // 创建用户
    if ($action2 == 'user_create') {

        $email = param('email');

        empty($email) and message('email', lang('please_input_email'));
        !is_email($email, $err) and message('email', $err);
        empty($conf['user_create_email_on']) and message(-1, lang('email_verify_not_on'));
        $_user = user_read_by_email($email);
        !empty($_user) and message('email', lang('email_is_in_use'));

        $code = rand(100000, 999999);
        $_SESSION['user_create_email'] = $email;
        $_SESSION['user_create_code'] = $code;


        // 重置密码，往老地址发送
    } elseif ($action2 == 'user_resetpw') {

        $email = param('email');

        empty($email) and message('email', lang('please_input_email'));
        !is_email($email, $err) and message('email', $err);
        $_user = user_read_by_email($email);
        empty($_user) and message('email', lang('email_is_not_in_use'));

        empty($conf['user_resetpw_on']) and message(-1, lang('resetpw_not_on'));

        $code = rand(100000, 999999);
        $_SESSION['user_resetpw_email'] = $email;
        $_SESSION['user_resetpw_code'] = $code;

    } else {
        message(-1, 'action2 error');
    }


    $subject = lang('send_code_template', array('rand' => $code, 'sitename' => $conf['sitename']));
    $message = $subject;

    $smtplist = include _include(APP_PATH . 'conf/smtp.conf.php');
    $n = array_rand($smtplist);
    $smtp = $smtplist[$n];

    // hook user_send_code_before.php
    $r = xn_send_mail($smtp, $conf['sitename'], $email, $subject, $message);
    // hook user_send_code_after.php

    if ($r === TRUE) {
        message(0, lang('send_successfully'));
    } else {
        xn_log($errstr, 'send_mail_error');
        message(-1, $errstr);
    }

// 简单的同步登陆实现：| sync login implement simply
    /*
        将用户信息通过 token 传递给其他系统 | send user information to other system by token
        两边系统将 auth_key 设置为一致，用 xn_encrypt() xn_decrypt() 加密解密。all subsystem set auth_key to correct by xn_encrypt() xn_decrypt()
    */
} elseif ($action == 'synlogin') {

    // 检查过来的 token | check token
    $token = param('token');
    $return_url = param('return_url');

    $s = xn_decrypt($token);
    !$s and message(-1, lang('unauthorized_access'));
    list($_time, $_useragent) = explode("\t", $s);
    $useragent != $_useragent and message(-1, lang('authorized_get_failed'));

    empty($_SESSION['return_url']) and $_SESSION['return_url'] = $return_url;
    if (!$uid) {
        http_location(url('user-login'));
    } else {
        $return_url = _SESSION('return_url');

        empty($return_url) and message(-1, lang('request_synlogin_again'));
        unset($_SESSION['return_url']);

        $arr = array(
            'uid' => $user['uid'],
            'gid' => $user['gid'],
            'username' => $user['username'],
            'avatar_url' => $user['avatar_url'],
            'email' => $user['email'],
            'mobile' => $user['mobile'],
        );
        $s = xn_json_encode($arr);
        $s = xn_encrypt($s);

        // 将 token 附加到 URL，跳转回去 | add token into URL, jump back
        $url = xn_urldecode($return_url) . '?token=' . $s;
        //$url = xn_url_add_arg($return_url, 'token', $s);
        http_location($url);
    }

} else if ($action == 'userdo') {
    $do = param('do');
    if (!in_array($do, ['dofollow', 'doblack'])) {
        die('{"error":"action error!!!"}');
    }
    if (empty($uid)) {
        die('{"error":"Please Login"}');
    }
    $toUid = param("uid");
    if ($toUid < 1) {
        die('{"error":"Uid is null"}');
    }
    $post = [
        'token' => $user['token'],
        'uid' => $toUid,
        'do' => 'add'
    ];
    $apiHTTP = new \SixparkSource\Oauth2\HTTPRequest($auth_config);
    $userDo = $apiHTTP->postWithAuth($auth_config['resource_host'] . "/index.php?app=user&act=" . $do, $post);
    die('{"success":"ok"}');
} else {

}

// hook user_end.php


?>
