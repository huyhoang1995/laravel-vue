<?php

namespace App\Http\Controllers\Rest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libs\Service\MatrixService;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Session;

class MatrixCtrl extends Controller
{
    private $matrixService;

    public function __construct(MatrixService $matrixService)
    {

        $this->matrixService = $matrixService;
    }

    public function getCLientServer()
    {
        try {
            $responseData = $this->matrixService->getCLientServer()->getJsonResult();

            return response()->json($responseData);
        } catch (Exception $e) {
            return response()->json(['status' => false], 422);
        }
    }
    public function logoutMatrix(Request $request)
    {
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect()->route('login');
    }
    public function loginMatrix(Request $request)
    {
        $user = $request->user;
        $password = $request->password;

        try {

            $responseData = $this->matrixService->loginMatrix($user, $password)->getJsonResult();
            // return response()->json($responseData);

            $accessToken = response()->json($responseData->access_token);

            $request->session()->put('accesToken', $accessToken);

            if ($accessToken) {
                # code...          
                return response()->json($responseData);
            } else {
                return response()->json(['status' => $responseData], 422);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => $responseData], 422);
        }
    }

    public function registerAccount(Request $request)
    {
        $user = $request->user;
        $password = $request->password;
        try {

            $responseData = $this->matrixService->registerAccount($user, $password)->getJsonResult();

            # code...          
            return response()->json($responseData);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => false], 422);
        }
    }

    public function createChatRoom(Request $request)
    {

        $roomName = $request->roomName;
        $roomAlias = str_replace(' ', '', $roomName);

        try {

            $responseData = $this->matrixService->createChatRoom($roomName, $roomAlias)->getJsonResult();
            return response()->json($responseData);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => false], 422);
        }
    }

    public function getListRoom(Request $request)
    {
        try {
            $responseData = $this->matrixService->getListRoom()->getJsonResult();

            return response()->json($responseData);
        } catch (Exception $e) {
            return response()->json(['status' => false], 422);
        }
    }

    public function sendMessage(Request $request)
    {
        $message = $request->message;
        $roomId = $request->roomId;
        try {
            $responseData = $this->matrixService->sendMessage($message, $roomId)->getJsonResult();

            return response()->json($responseData);
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function chatRoomHistory(Request $request)
    {
        $roomId = $request->roomId;
        // return $roomId;
        try {
            $responseData = $this->matrixService->chatRoomHistory($roomId)->getJsonResult();

            return response()->json($responseData);
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function listMemberRoom(Request $request)
    {
        $roomId = $request->roomId;
        try {
            $responseData = $this->matrixService->listMemberRoom($roomId)->getJsonResult();

            return response()->json($responseData);
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function getNameRoom(Request $request)
    {
        $roomId = $request->roomId;
        try {
            $responseData = $this->matrixService->getNameRoom($roomId)->getJsonResult();

            return response()->json($responseData);
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    // moi vao phong
    public function inviteMember(Request $request)
    {
        $roomId = $request->roomId;
        $userId = $request->userId;
        try {
            $responseData = $this->matrixService->inviteMember($roomId, $userId)->getJsonResult();

            return response()->json($responseData);
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function joinRoom(Request $request)
    {
        $roomId = $request->roomId;
        try {
            $responseData = $this->matrixService->joinRoom($roomId)->getJsonResult();

            return response()->json($responseData);
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function leaveRoom(Request $request)
    {
        $roomId = $request->roomId;
        try {
            $responseData = $this->matrixService->leaveRoom($roomId)->getJsonResult();

            return response()->json($responseData);
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getEvent(Request $request)
    {
        try {
            $responseData = $this->matrixService->getEvent()->getJsonResult();

            return response()->json($responseData);
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function tokenRefresh(Request $request)
    {
        try {

            $responseData = $this->matrixService->tokenRefresh()->getJsonResult();

            return response()->json($responseData);

            // $accessToken = response()->json($responseData->access_token);

            // $request->session()->put('accesToken', $accessToken);


            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function uploadImages(Request $request)
    {
        $roomId = $request->roomId;

        $url = $request->url;

        $images_name = $request->nameImages;

        try {

            $responseData = $this->matrixService->uploadImages($roomId, $images_name, $url)->getJsonResult();

            return response()->json($responseData);

            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function uploadFileCommon(Request $request)
    {
        if ($request->hasFile('images')) {
            // $data = file_get_contents($request->images);

            // $array = array();
            // foreach (str_split($data) as $char) {
            //     array_push($array, ord($char));
            // }
            // $images = implode(' ', $array);

            // $filename = base_path() . '/public/images/avatar.png';
            $filename = $request->images;
            $handle = fopen($filename, "rb");
            $fsize = filesize($filename);
            $contents = fread($handle, $fsize);
            $byteArray = unpack("N*", $contents);
            // $images = base_path() . '/public/images/avatar.png';
        } else {
            return 'null';
        }
        try {

            $responseData = $this->matrixService->uploadFileCommon($byteArray)->getJsonResult();

            return response()->json($responseData);

            // $accessToken = response()->json($responseData->access_token);

            // $request->session()->put('accesToken', $accessToken);


            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function sendMess(Request $request)
    {
        $phoneNumber = $request->phoneNumber;
        $checkNumber = substr($phoneNumber, 0, 3);

        if ($checkNumber != "+84") {
            $phoneNumber = substr($phoneNumber, 1);
            $phoneNumber = "+84" . $phoneNumber;
        }

        $content = $request->content;
        try {
            $responseData = $this->matrixService->sendMess($phoneNumber, $content)->getJsonResult();

            return response()->json($responseData);
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
