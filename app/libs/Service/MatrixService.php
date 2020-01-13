<?php

namespace App\Libs\Service;

use App\Libs\MyHttp\Http;
use App\Libs\Config\SessionKeyConfig;
use Illuminate\Http\Request;
use Session;

// clinic
class MatrixService
{
    private $http;

    private $matrixServer;
    private $request;

    function __construct()
    {

        $this->request = new Request;

        $this->http = new Http();

        $this->matrixServer = config('myService.matrixServer');
    }


    public function getHeader()
    {
        return
            $this->http->setHeader([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]);
    }
    public function getCLientServer()
    {

        $url = $this->matrixServer . '/.well-known/matrix/client';

        return $this->http->get($url);
    }
    public function getEvent()
    {

        $url = $this->matrixServer . '/_matrix/client/r0/sync?access_token=' . Session::get('accesToken')->original;

        return $this->http->get($url);
    }

    public function loginMatrix($user, $password)
    {
        $this->getHeader();

        $url = $this->matrixServer . '/_matrix/client/r0/login';

        $data = [
            'user' => $user,
            'password' => $password,
            'type' => 'm.login.password',
        ];

        $response = $this->http->post($url, $data);

        return $response;
    }
    public function registerAccount($user, $password)
    {
        $this->getHeader();

        $url = $this->matrixServer . '/_matrix/client/r0/register';
        $data = [
            'username' => $user,
            'password' => $password,
            'auth' => [
                "type" => "m.login.dummy"
            ],
        ];

        $response = $this->http->post($url, $data);

        return $response;
    }
    public function createChatRoom($roomName, $roomAlias)
    {
        $this->getHeader();

        $url = $this->matrixServer . '/_matrix/client/r0/createRoom?access_token=' . Session::get('accesToken')->original;

        $data = [
            "room_alias_name" => $roomAlias,
            "name" =>  $roomName,
        ];

        $response = $this->http->post($url, $data);

        return $response;
    }

    //danh sach phong
    public function getListRoom()
    {

        $url = $this->matrixServer . '/_matrix/client/r0/sync?filter={"room":{"timeline":{"limit":1}}}&access_token=' . Session::get('accesToken')->original;

        return $this->http->get($url);
    }
    // danh sach tin nhắn
    public function chatRoomHistory($roomId)
    {

        $url = $this->matrixServer . '/_matrix/client/r0/rooms/' . $roomId . '/messages?dir=b&limit=1000000&access_token=' . Session::get('accesToken')->original;

        return $this->http->get($url);
    }

    // danh sach nguoi trong phong
    public function listMemberRoom($roomId)
    {

        $url = $this->matrixServer . '/_matrix/client/r0/rooms/' . $roomId . '/members?access_token=' . Session::get('accesToken')->original;

        return $this->http->get($url);
    }

    public function inviteMember($roomId, $userId)
    {
        $this->getHeader();
        $data = [
            "user_id" => $userId
        ];

        $url = $this->matrixServer . '/_matrix/client/r0/rooms/' . $roomId . '/invite?access_token=' . Session::get('accesToken')->original;

        $response = $this->http->post($url, $data);

        return $response;
    }
    public function joinRoom($roomId)
    {
        $this->getHeader();
        $data = [];

        $url = $this->matrixServer . '/_matrix/client/r0/rooms/' . $roomId . '/join?access_token=' . Session::get('accesToken')->original;
        $response = $this->http->post($url, $data);

        return $response;
    }
    public function leaveRoom($roomId)
    {
        $this->getHeader();

        $url = $this->matrixServer . '/_matrix/client/r0/rooms/' . $roomId . '/leave?access_token=' . Session::get('accesToken')->original;
        $response = $this->http->post($url);

        return $response;
    }
    public function getNameRoom($roomId)
    {

        $url = $this->matrixServer . '/_matrix/client/r0/rooms/' . $roomId . '/state/m.room.name?access_token=' . Session::get('accesToken')->original;

        return $this->http->get($url);
    }
    //gui tin nhan
    public function sendMessage($message, $roomId)
    {

        $this->getHeader();
        $url = $this->matrixServer . '/_matrix/client/r0/rooms/' . $roomId . '/send/m.room.message?access_token=' . Session::get('accesToken')->original;

        $data = [
            "msgtype" => "m.text",
            "body" => $message
        ];

        $response = $this->http->post($url, $data);

        return $response;
    }
    public function tokenRefresh()
    {

        $this->getHeader();


        $url = $this->matrixServer . '/_matrix/client/r0/tokenrefresh?access_token=' . Session::get('accesToken')->original;
        $response = $this->http->post($url);
        return $response;
    }
    public function uploadImages($roomId, $images_name, $url)
    {
        $this->getHeader();


        $data = [

            "body" => $images_name,
            "info" => [
                "h" => 398,
                "mimetype" => "image/jpeg",
                "size" => 31037,
                "w" => 394
            ],
            "msgtype" => "m.image",
            "url" => $url,

            // data mẫu
            // "body" => $images_name,
            // "info" => [
            //     "h" => 183,
            //     "mimetype" => "image/jpeg ",
            //     "size " => 6065,
            //     "thumbnail_info" => ["w" => 275, "h" => 183, "mimetype" => "image/jpeg", "size" => 8742],
            //     "thumbnail_url " => "mxc://matrix.org/ASxcTbcAeLwAoVlgjIkMazyx",
            //     "w" => 275,
            // ],
            // "msgtype" => "m.image",
            // "url" => "mxc://matrix.org/NAmsxRITQuTJRFKyuEWVghzM",
        ];
        $url = $this->matrixServer . '/_matrix/client/r0/rooms/' . $roomId . '/send/m.room.message?access_token=' . Session::get('accesToken')->original;

        $response = $this->http->post($url, $data);

        return $response;
    }

    public function uploadFileCommon($images)
    {
        $this->getHeader();
        // $this->http->setHeader([
        //     'Content-Type' => 'application/pdf',
        //     'Accept' => 'application/json',
        // ]);

        $url = $this->matrixServer . '/_matrix/media/r0/upload?access_token=' . Session::get('accesToken')->original;
        $response = $this->http->post($url, $images);

        return $response;
    }
    public function sendMess($phoneNumber, $content)
    {
        $this->getHeader();
        // $this->http->setHeader([
        //        'Content-Type' => 'application/pdf',
        //     'Accept' => 'application/json',
        // ]);

        $url = "https://rest.nexmo.com/sms/json";

        $data = [
            "from" => "AcmeInc",
            "text" => $content,
            "to" => $phoneNumber,
            "api_key" => "29d0df9a",
            "api_secret" => "MKsHmZ07pkd3K4p5",
        ];
        $response = $this->http->post($url, $data);

        return $response;
    }
}
