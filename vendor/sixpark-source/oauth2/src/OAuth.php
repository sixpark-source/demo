<?php

namespace SixparkSource\Oauth2;

class OAuth
{
    var $httpRequest;
    var $config;
    public function __construct($config)
    {
        $this->httpRequest = new HTTPRequest($config);
        $this->config = $config;
    }

    public function requestTokenWithAuthCode($code){
        $query = array(
            'grant_type'    => 'authorization_code',
            'code'          => $code,
            'client_id'     => $this->config['client_id'],
            'client_secret' => $this->config['client_secret']
        );
        $result = $this->httpRequest->postWithAuth($this->config['token_route'],$query);
        return $result;
    }

}