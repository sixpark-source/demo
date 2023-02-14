<?php
/**
 * 处理用户回调的问题
 */
!defined('DEBUG') AND exit('Access Denied.');
$action = param(1);
$auth_config = @include APP_PATH.'conf/conf.auth.php';
if($action == 'receiveAuthorizationCode')
{
    $code = trim($_GET['code']);
    if(!empty($code))
    {
        $auth_config = @include APP_PATH.'conf/conf.auth.php';
        $query = array(
            'grant_type'    => 'authorization_code',
            'code'          => $code,
            'client_id'     => $auth_config['client_id'],
            'client_secret' => $auth_config['client_secret']
        );
        $oauth = new \SixparkSource\Oauth2\OAuth($auth_config);
        $resultJson = $oauth->requestTokenWithAuthCode($code);
        $result = json_decode($resultJson,true);
        /**
        Array
        (
        [access_token] => bXoeI9ByaDLzfv12b6R96+J5ksw93jHeefjMgXm5BKWIhFQCcyqknq7Z2/0m1HH0mhi/F3SSE5hyU3arFJMV0XZ9K9hAVj/3/eg5QmzBhD4=
        [expires_in] => 86400
        [token_type] => Bearer
        [scope] =>
        [refresh_token] => e519064089c141ff52de1a12bc1f425e0df558a4
        )
         */
        if(!empty($result['access_token']))
        {
            $apiHTTP = new \SixparkSource\Oauth2\HTTPRequest($auth_config);
            $data = [
                'token' =>  $result['access_token']
            ];
            $user_info_json = $apiHTTP->postWithAuth($auth_config['resource_host']."/index.php?app=user&act=userinfo",$data);
            $user_info = json_decode($user_info_json,true);
            if($user_info['status'] == 2202 && !empty($user_info['info']['uid']))
            {
                $expires = time() + $result['expires_in'];
                $user_info_local = db_sql_find_one("select * from bbs_user_auth where uid=".intval($user_info['info']['uid']));
                if(empty($user_info_local))
                {

                    $dbResult = db_exec("insert into bbs_user_auth set uid='".$user_info['info']['uid']."',username='".addslashes($user_info['info']['username'])."',token='".addslashes($result['access_token'])."',expires='".$expires."'");
                }
                else{
                    $dbResult =  db_exec("update bbs_user_auth set token='".addslashes($result['access_token'])."',expires='".$expires."'");
                }
                if($dbResult)
                {
                    $_SESSION['uid'] = $user_info['info']['uid'];
                    header("Location:index.php");
                }
                else{
                    die("用户信息错误，请重新授权");
                }
            }
            else{
                echo $user_info_json;
            }
        }
        die($resultJson);
    }
}
die("参数错误");