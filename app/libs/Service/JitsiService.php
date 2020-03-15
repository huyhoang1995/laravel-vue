<?php

namespace App\Libs\Service;

use App\Libs\MyHttp\Http;
use App\Libs\Config\SessionKeyConfig;
use Illuminate\Http\Request;
use Session;


class JitsiService
{
    private $http;

    private $jitsiServer;
    private $request;

    function __construct()
    {

        $this->request = new Request;

        $this->http = new Http();

        $this->jitsiServer = config('myService.jitsiServer');
    }


    public function getHeader()
    {
        return
            $this->http->setHeader([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]);
    }

    public function getSession(){
        if(Session::get(SessionKeyConfig::CONST_TOKEN_INFO_KEY)){
            $tokenInfo = Session::get(SessionKeyConfig::CONST_TOKEN_INFO_KEY)->token;
        }
        
        return $tokenInfo;

    }
  
    public function login($user, $password)
    {
        $this->getHeader();

        $url = $this->jitsiServer . '/login';

        $data = [
            'account' => $user,
            'password' => $password,
        ];

        $response = $this->http->post($url, $data);

        return $response;
    }
  
    public function userInfo()
    {
        $tokenInfo = "Bearer " . $this->getSession();
        $config = $this->http->setHeader([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            "Authorization" => $tokenInfo
        ]);

        $url = $this->jitsiServer . '/userInfo';

        return $this->http->get($url, $config);
    }
    
    public function listUser()
    {
        $tokenInfo = "Bearer " . $this->getSession();
        $config = $this->http->setHeader([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            "Authorization" => $tokenInfo
        ]);

        $url = $this->jitsiServer . '/user';

        return $this->http->get($url, $config);
    }
}
