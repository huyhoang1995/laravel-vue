<?php

namespace App\Libs\Service;
use App\Libs\MyHttp\Http;
use App\Libs\Config\SessionKeyConfig;
use Illuminate\Http\Request;
use Session;

// clinic
class ClinicService{
	private $http;
	private $baseUrl;
	private $userType;
	public $tokenKey;
	private $request;
	private $cligateUrl;

	function __construct()
	{

		$this->request = new Request;
		$this->http = new Http();
		$this->baseUrl = config('myService.authorizationServer');
		$this->cligateUrl = config('myService.clinicServer');
		$this->userType = config('myService.userType');

	}
	
	// lấy sesstion
	public function getSession(){
		try {
			if(Session::get(SessionKeyConfig::CONST_TOKEN_INFO_KEY)){
				$tokenInfo = Session::get(SessionKeyConfig::CONST_TOKEN_INFO_KEY)->access_token;
			}

			return $tokenInfo;
		} catch (\Throwable $th) {
			return false;
		}
	}

	public function encounterPatient($id, $startCreatedAt, $endCreatedAt, $page, $perPage){
		
		$tokenInfo = "Bearer " . $this->getSession();
		$this->http->setHeader([
			'Content-Type' => 'application/json',
			'Accept' => 'application/json',
			"Authorization" => $tokenInfo
		]);
		$data = [
			"startCreatedAt" => $startCreatedAt,
			"endCreatedAt" => $endCreatedAt,
			"page" => $page,
			"perPage" => $perPage,
		];

		$url = $this->cligateUrl . '/ehr/api/v1/encounter/'. $id . '?' . http_build_query($data);
		
		return $this->http->get($url);

	}



	public function indexPatient($id,$page,$perPage,$type,$numberOfVisits ){

		$tokenInfo = "Bearer " . $this->getSession();
		$this->http->setHeader([
			'Content-Type' => 'application/json',
			'Accept' => 'application/json',
			"Authorization" => $tokenInfo
		]);

		$url = $this->cligateUrl . '/ehr/api/v1/index/'. $id . '/' . $type . '?page=' . $page . '&perPage=' . $perPage . '&numberOfVisits=' . $numberOfVisits;

		return $this->http->get($url);
	}

}