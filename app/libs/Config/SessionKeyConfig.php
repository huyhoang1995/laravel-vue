<?php

namespace App\Libs\Config;

use Session;

class SessionKeyConfig{

	const CONST_TOKEN_INFO_KEY = 'tokenInfo';
	const CONST_USER_INFO_KEY = 'userInfo';

	function getSession(){
		if(Session::get('tokenInfo')){
			return Session::get('tokenInfo')->accessToken;
		}		
	}
}