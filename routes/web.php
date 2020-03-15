<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
// |
// */

Route::get('/', function () {
    return view('welcome');
});
Route::get('/loginJitsi', function () {
    return view('loginJitsi');
});
Route::get('/videoJitsi', function () {
    return view('videoCall');
});
Route::get('/test', function () {
    return view('test');
});


// Route::get('/', function () {
//     return view('welcome');
// })->name('index')->middleware('myAuth');

Route::get('/login', function () {
    return view('login');
})->name('login');

// Route::get('/pdf', function () {
//     return view('myPdfFile');
// })->name('pdf');

// Route::get('/sendEmail', 'EmailController@sendEmail');
// Route::get('/home', 'Rest\HomeComtroller@index');
Route::group(['prefix' => 'rest', 'middleware' => ['web']], function () {
    Route::get('generate-pdf', 'Rest\PdfCtrl@generatePDF');
    Route::get('getPrint', 'Rest\SnappyCtrl@getPrint');


    Route::get('/example', 'Rest\ExampleCtrl@listExample');
    Route::post('/example', 'Rest\ExampleCtrl@createExample');
    Route::put('/example/{id}', 'Rest\ExampleCtrl@editExample');
    Route::delete('/example/{id}', 'Rest\ExampleCtrl@deleteExample');

    //item
    Route::get('/item', 'Rest\ItemCtrl@listItem');
    Route::get('/item/{id}', 'Rest\ItemCtrl@singleItem');
    Route::post('/item', 'Rest\ItemCtrl@insertItem');
    Route::post('/item/{id}', 'Rest\ItemCtrl@updateItem');
    Route::delete('/item/{id}', 'Rest\ItemCtrl@deleteItem');
    Route::get('/startNofify', 'Rest\ItemCtrl@startNofify');

    // matrix
    Route::get('/getCLientServer', 'Rest\MatrixCtrl@getCLientServer');
    Route::get('/getListRoom', 'Rest\MatrixCtrl@getListRoom');
    Route::get('/getEvent', 'Rest\MatrixCtrl@getEvent');
    Route::get('/getNameRoom', 'Rest\MatrixCtrl@getNameRoom');
    Route::get('/chatRoomHistory', 'Rest\MatrixCtrl@chatRoomHistory');
    Route::get('/listMemberRoom', 'Rest\MatrixCtrl@listMemberRoom');
    Route::post('/loginMatrix', 'Rest\MatrixCtrl@loginMatrix');
    Route::post('/logoutMatrix', 'Rest\MatrixCtrl@logoutMatrix')->name('logout');
    Route::post('/registerAccount', 'Rest\MatrixCtrl@registerAccount');
    Route::post('/createChatRoom', 'Rest\MatrixCtrl@createChatRoom');
    Route::post('/sendMessage', 'Rest\MatrixCtrl@sendMessage');
    Route::post('/inviteMember', 'Rest\MatrixCtrl@inviteMember');
    Route::post('/joinRoom', 'Rest\MatrixCtrl@joinRoom');
    Route::post('/leaveRoom', 'Rest\MatrixCtrl@leaveRoom');
    Route::post('/tokenRefresh', 'Rest\MatrixCtrl@tokenRefresh');
    Route::post('/uploadImages', 'Rest\MatrixCtrl@uploadImages');
    Route::post('/uploadFileCommon', 'Rest\MatrixCtrl@uploadFileCommon');
    Route::post('/sendMess', 'Rest\MatrixCtrl@sendMess');

    //jitsi
    Route::post('/loginJitsi', 'Rest\JitsiCtrl@login');
    Route::get('/logout', 'Rest\JitsiCtrl@logout');

    Route::get('/userInfo', 'Rest\JitsiCtrl@userInfo');
    Route::get('/listUser', 'Rest\JitsiCtrl@listUser');
    
});
Route::get('/laravel-filemanager', '\Unisharp\Laravelfilemanager\controllers\LfmController@show');
Route::post('/laravel-filemanager/upload', '\Unisharp\Laravelfilemanager\controllers\UploadController@upload');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
