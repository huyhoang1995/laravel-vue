<?php
namespace App\Libs\MyHttp; 

class HttpResult{
    
    private $result;
    private $info;
    
    function __construct($result, $info) {
        $this->result = $result;
        $this->info = $info;
    }
    
    function getBody(){
        return $this->result;
    }
    
    function getJsonResult(){
        return json_decode($this->result);
    }
    
    function getRpcResult(){
        return xmlrpc_decode($this->result);
    }
    
    function hasRpcError(){
        $normalError = $this->hasError();
        if($normalError) return true;
        return xmlrpc_is_fault(xmlrpc_decode($this->result));
    }
    
    function hasError(){
        $info = $this->info;
        $httpCode = (int)$info['http_code'];
        return ($httpCode >= 200 && $httpCode <= 299)? false: true;
    }
    
    function getInfo(){
        return $this->info;
    }
    
    function getHttpStatus(){
        return $this->info['http_code'];
    }
}