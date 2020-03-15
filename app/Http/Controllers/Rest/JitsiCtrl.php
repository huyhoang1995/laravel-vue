<?php

namespace App\Http\Controllers\Rest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Libs\Service\JitsiService;
use App\Libs\MyHttp\Http;
use App\Libs\Config\SessionKeyConfig;

class JitsiCtrl extends Controller
{
    //
	private $jitsiService;
	private $http;

    public function __construct(Http $http, JitsiService $jitsiService){
		$this->http = $http;
		$this->jitsiService = $jitsiService;
	}

    public function login(Request $request)
    {
        $account = $request->account;
        $password = $request->password;
        try {
			$responseData = $this->jitsiService->login($account, $password)->getJsonResult();
            $request->session()->put(SessionKeyConfig::CONST_TOKEN_INFO_KEY, $responseData);
            
			return response()->json($responseData);	   
		} catch (Exception $e) {
			return response()->json(['errMsg' => 'Xảy ra lỗi hệ thống'], 422);
		} 
    }

	public function userInfo()
	{
		try{
			$responseData = $this->jitsiService->userInfo()->getJsonResult();
			return response()->json($responseData);	   
		}catch(Exception $e){
			return response()->json(['errMsg' => 'Xảy ra lỗi hệ thống'], 422);
		}
	}
	
	public function listUser()
	{
		try{
			$responseData = $this->jitsiService->listUser()->getJsonResult();
			return response()->json($responseData);	   
		}catch(Exception $e){
			return response()->json(['errMsg' => 'Xảy ra lỗi hệ thống'], 422);
		}
	}

	public function logout(Request $request) {
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->route('login');
    }
}
