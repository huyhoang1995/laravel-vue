<?php

namespace App\Libs\Service;
use App\Libs\MyHttp\Http;
use App\Libs\Config\SessionKeyConfig;
use Illuminate\Http\Request;
use Session;
use App\Libs\Service\AuthozirationService;

// clinic
class TariffService{
	private $http;
	private $baseUrl;
	public $tokenKey;
	private $request;
	private $cligateUrl;

	function __construct(AuthozirationService $authozirationService)
	{
		$this->authozirationService = $authozirationService;
		$this->request = new Request;
		$this->http = new Http();
		$this->baseUrl = config('myService.authorizationServer');
		$this->cligateUrl = config('myService.clinicServer');
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

	public function getEncrypt()
	{
		$encryptUser = $this->authozirationService->getEncrypt()->getJsonResult();
		return $encryptUser->encrytUserInfo;
	}

	public function listTariff($page,$perPage,$freeText)
	{	
		$tokenInfo = "Bearer " . $this->getSession();
		$config = $this->http->setHeader([
			'Content-Type' => 'application/json',
			'Accept' => 'application/json',
			"Authorization" => $tokenInfo
		]);
		$url = $this->cligateUrl . '/tariff/api/v1/tariff?page=' . $page . '&perPage=' . $perPage . '&freeText=' .  $freeText;

		return $this->http->get($url,$config);

	}

	public function createTariff($name,$description,$duration,$money,$programId)
	{
		$tokenInfo = "Bearer " . $this->getSession();
		$config = $this->http->setHeader([
			'Content-Type' => 'application/json',
			'Accept' => 'application/json',
			"Authorization" => $tokenInfo
		]);

		$data = [
			'name' => $name,  
			'description' => $description,  
			'duration' => $duration,  
			'money' => $money,
			'programId' => $programId,
		];
		$url = $this->cligateUrl . '/tariff/api/v1/tariff';

		return $this->http->post($url, $data, $config);

	}

	public function updateTariff($name,$description,$duration,$money,$programId,$tariffId)
	{
		$tokenInfo = "Bearer " . $this->getSession();
		$config = $this->http->setHeader([
			'Content-Type' => 'application/json',
			'Accept' => 'application/json',
			"Authorization" => $tokenInfo
		]);

		$data = [
			'name' => $name,  
			'description' => $description,  
			'duration' => $duration,  
			'money' => $money,
			'programId' => $programId,
		];

		$url = $this->cligateUrl . '/tariff/api/v1/tariff/' . $tariffId;

		return $this->http->put($url, $data, $config);

	}

	public function deleteTariff($tariffId)
	{
		$tokenInfo = "Bearer " . $this->getSession();
		$config = $this->http->setHeader([
			'Content-Type' => 'application/json',
			'Accept' => 'application/json',
			"Authorization" => $tokenInfo
		]);

		$url = $this->cligateUrl . '/tariff/api/v1/tariff/' . $tariffId;

		return $this->http->delete($url, $config);

	}

	public function detailTariff($tariffId)
	{
		$tokenInfo = "Bearer " . $this->getSession();
		$config = $this->http->setHeader([
			'Content-Type' => 'application/json',
			'Accept' => 'application/json',
			"Authorization" => $tokenInfo
		]);

		$url = $this->cligateUrl . '/tariff/api/v1/tariff/' . $tariffId;

		return $this->http->get($url, $config);
	}

	public function changeStatus($id,$status)
	{	
		$tokenInfo = "Bearer " . $this->getSession();
		
		$config = $this->http->setHeader([
			'Content-Type' => 'application/json',
			'Accept' => 'application/json',
			"Authorization" => $tokenInfo
		]);

		$data = [
			'status' => $status,
		];

		$url = $this->cligateUrl . '/tariff/api/v1/tariff/changeStatus/' . $id;

		return $this->http->put($url, $data, $config);
	}

	public function listProgram()
	{
		$tokenInfo = "Bearer " . $this->getSession();
		$config = $this->http->setHeader([
			'Content-Type' => 'application/json',
			'Accept' => 'application/json',
			"Authorization" => $tokenInfo
		]);

		$url = $this->cligateUrl . '/program/api/v1/program';

		return $this->http->get($url,$config);
	}

	public function assignPatient($patientId,$tariffId)
	{
		$tokenInfo = "Bearer " . $this->getSession();
		$config = $this->http->setHeader([
			'Content-Type' => 'application/json',
			'Accept' => 'application/json',
			"Authorization" => $tokenInfo
		]);

		$data = [
			'patientId' => $patientId,  
			'tariffId' => $tariffId,  
		];

		$url = $this->cligateUrl . '/tariff/api/v1/tariff/assign';

		return $this->http->post($url,$data,$config);

	}
}