<?php

namespace App\Libs\Service;

use App\Libs\MyHttp\Http;
use App\Libs\Config\SessionKeyConfig;
use Illuminate\Http\Request;
use Session;
class AuthozirationService{

    private $http;
    private $baseUrl;
    private $userType;
    function __construct()
    {
        $this->http = new Http();
        $this->http->setHeader([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'client-id'=> config('myService.clientId'),
            'client-secret'=> config('myService.clientSecret')
        ]);
        $this->baseUrl = config('myService.authorizationServer');
        $this->userType = config('myService.userType');
    }

    /**
     * Thuc hien dang nhap
     *
     * @param [type] $user
     * @param [type] $pass
     * @return void
     */
    public function login($user, $pass){
        $url = $this->baseUrl . '/api/v1/login';
        $data = [
            'account' => $user,  
            'password' =>  $pass,
            'type' => $this->userType 
        ];
        
        $response = $this->http->post($url, $data);

        return $response;
    }

    //tạo sesstion
    public function getSession(){
        if(Session::get(SessionKeyConfig::CONST_TOKEN_INFO_KEY)){
            $tokenInfo = Session::get(SessionKeyConfig::CONST_TOKEN_INFO_KEY)->access_token;
        }

        return $tokenInfo;

    }
    public function getEncrypt()
    {
        $tokenInfo = "Bearer " . $this->getSession();
        $this->http->setHeader([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            "Authorization" => $tokenInfo
        ]);

        $url = $this->baseUrl . '/api/v1/userEncrypt';
        return $this->http->get($url);
        
    }
    //tạo mới người dùng
    public function creatUser($name,$phone,$email,$address,$gender,$role)
    {   
        $tokenInfo = "Bearer"." ".$this->getSession();
        $this->http->setHeader([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            "Authorization" => $tokenInfo
        ]);

        $url = $this->baseUrl . '/api/v1/user/clinic';
        $data = [
            'name' => $name,  
            'phone' => $phone,  
            'email' => $email,  
            'address' => $address,  
            'gender' => $gender,  
            'role' => $role,  
        ];
        
        return $this->http->post($url, $data);
    }

    //cập nhật quyền
    public function changeRole($id,$role)
    {   
        $tokenInfo = "Bearer"." ".$this->getSession();
        $this->http->setHeader([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            "Authorization" => $tokenInfo
        ]);
        $url = $this->baseUrl . '/api/v1/user/clinic/changeRole/' . $id;
        $data = [
            'role' =>$role,
        ];
        return $this->http->put($url, $data);
    }


    //danh sách user
    public function listUser($freeText,$name,$role,$email,$phone,$page,$perPage)
    {
        $tokenInfo = "Bearer"." ".$this->getSession();
        $this->http->setHeader([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            "Authorization" => $tokenInfo
        ]);

        $url = $this->baseUrl . '/api/v1/clinic?freeText=' . $freeText . '&page=' . $page . '&perPage=' . $perPage . '&role=' . $role . '&name=' . $name. '&email=' . $email . '&phone=' . $phone;

        return $this->http->get($url);

    }
    
    //cập nhật thồng tin 
    public function updateUserClinic($name,$phone,$email,$address,$gender)
    {
        $tokenInfo = "Bearer"." ".$this->getSession();
        $this->http->setHeader([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            "Authorization" => $tokenInfo
        ]);

        $url = $this->baseUrl . '/api/v1/user/clinic';

        $data = [
            'name' => $name,  
            'phone' => $phone,  
            'email' => $email,  
            'address' => $address,  
            'gender' => $gender,  
        ];
        return $this->http->put($url, $data);
    }

    //xóa người dùng
    public function deleteUser($id)
    {
        $tokenInfo = "Bearer"." ".$this->getSession();
        $this->http->setHeader([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            "Authorization" => $tokenInfo
        ]);

        $url = $this->baseUrl . '/api/v1/user/' . $id;
        return $this->http->delete($url);
    }

    //đổi mật khẩu
    public function changePassword($oldPassword, $newPassword)
    {
        $tokenInfo = "Bearer"." ".$this->getSession();
        $this->http->setHeader([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            "Authorization" => $tokenInfo
        ]);

        $data = [

            'oldPassword' => $oldPassword,  
            'newPassword' => $newPassword,  

        ];
        $url = $this->baseUrl . '/api/v1/user/changePassword';

        return $this->http->put($url, $data);
    }

    //reset mật khẩu
    public function resetPassword($id, $userType, $password)
    {

        $tokenInfo = "Bearer"." ".$this->getSession();
        $this->http->setHeader([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            "Authorization" => $tokenInfo
        ]);
        $data = [];

        if ($password) {
            $data['password'] = $password;
        }
        $url = $this->baseUrl . '/api/v1/user/resetPassword/'. $userType .'/' .$id;

        return $this->http->put($url, $data);

    }

    //cập nhật avatar
    public function uploadAvatar($fileName,$content)
    {
        $tokenInfo = "Bearer"." ".$this->getSession();
        $this->http->setHeader([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            "Authorization" => $tokenInfo
        ]);

        $data = [
            'content' => $content,
            'fileName' => $fileName
        ];

        $url = $this->baseUrl . '/api/v1/user/avatar';

        return $this->http->post($url, $data);
    }

    //thông tin người dùng hiện tại
    public function userInfo(){

        $tokenInfo = "Bearer"." ".$this->getSession();
        $this->http->setHeader([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            "Authorization" => $tokenInfo
        ]);

        $url = $this->baseUrl . '/api/v1/userInfo';
        return $this->http->get($url);
    }

    //danh sách vai trò
    public function listRole(Request $request){

        $tokenInfo = "Bearer"." ".$this->getSession();
        $this->http->setHeader([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            "Authorization" => $tokenInfo
        ]);

        $url = $this->baseUrl . '/api/v1/role/clinic';
        return $this->http->get($url);
    }

    //danh sách bệnh nhân
    public function listPatient($freeText, $page, $perPage){
        $tokenInfo = "Bearer"." ".$this->getSession();
        $this->http->setHeader([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            "Authorization" => $tokenInfo
        ]);

        $url = $this->baseUrl . '/api/v1/patient?page='.$page.'&perPage='.$perPage.'&freeText='.$freeText;

        return $this->http->get($url);
    }

        //tạo bệnh nhân
    public function createPatient($name, $phone, $email, $address, $gender, $birthday, $patientId,  $password ){

        $tokenInfo = "Bearer"." ".$this->getSession();
        $this->http->setHeader([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            "Authorization" => $tokenInfo
        ]);
        $url = $this->baseUrl . '/api/v1/user/patient';

        $data = [
            'name'    => $name,  
            'phone'   => $phone,
            'email'   => $email, 
            'address' => $address, 
            'gender'  => $gender, 
            'birthday'    => $birthday,
            'patientId'    => $patientId,
        ];

        if ($password) {
            $data['password'] = $password;
        }


        return $this->http->post($url, $data);
    }

        //xóa bệnh nhân
    public function deletePatient($id){
        $tokenInfo = "Bearer"." ".$this->getSession();
        $this->http->setHeader([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            "Authorization" => $tokenInfo
        ]);
        $url = $this->baseUrl . '/api/v1/user/'. $id;

        return $this->http->delete($url);
    }

    public function patientInfo($id){

        $tokenInfo = "Bearer"." ".$this->getSession();
        $this->http->setHeader([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            "Authorization" => $tokenInfo
        ]);


        $url = $this->baseUrl . '/api/v1/patientInfo/'. $id;
        return $this->http->get($url);

    }
}