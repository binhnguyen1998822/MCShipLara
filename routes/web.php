<?php
use Illuminate\Http\Request;

Route::get('myip', function (Request $request) {
    echo $request->ip();
});
Route::get('/app', function () {
    return redirect('shiper.apk');
});
Route::get('/', function () {
    return redirect('home');
});
Route::get('/logout', function () {
    Auth::logout();
    return redirect('home');
});

Auth::routes();
//xuất excel
Route::get('exportdh', 'UsersController@export')->middleware('adminLogin');

//dashboard
Route::get('home', 'DashboardController@mainview')->middleware('adminLogin');
Route::get('chart', 'DashboardController@chartincome')->middleware('adminLogin');
Route::get('dashboard', 'DashboardController@mainview')->middleware('adminLogin');
//profile
Route::get('profile', 'ProfileController@profile')->middleware('adminLogin');
//donhang
Route::get('donhang', 'UsersController@donhang')->middleware('adminLogin');
Route::get('donhang/{id}', 'UsersController@status')->middleware('adminLogin');
Route::get('deldonhang/{id}', 'UsersController@deldonhang')->middleware('adminLogin');
Route::post('donhang/{id}', 'UsersController@pstatus')->middleware('adminLogin');
//addonhang
Route::post('nhap', 'UsersController@nhapdl')->middleware('adminLogin');
//mã thẻ
Route::post('pmathe/{id}', 'MatheController@pmathe')->middleware('adminLogin');
Route::get('mathe/{id}', 'MatheController@getmathe')->middleware('adminLogin');
Route::get('mathe', 'MatheController@mathe')->middleware('adminLogin');
Route::get('mathe/{squirrel}/{any}', 'MatheController@checkbox');
//admin
Route::get('adduser', 'AdminController@adduser')->middleware('adminLogin');
Route::get('adduser/{id}', 'AdminController@deluser')->middleware('adminLogin');

Route::get('addbank', 'AdminController@addbank')->middleware('adminLogin');
Route::post('addbank', 'AdminController@addpbank')->middleware('adminLogin');
Route::get('delbank/{idb}', 'AdminController@delbank')->middleware('adminLogin');

Route::get('addship', 'AdminController@addship')->middleware('adminLogin');
Route::get('addship/{id_sp}', 'AdminController@delshipper')->middleware('adminLogin');
Route::post('addpship', 'AdminController@addpship')->middleware('adminLogin');

Route::get('color', 'AdminController@color')->middleware('adminLogin');
Route::get('color/{id_cl}', 'AdminController@delcolor')->middleware('adminLogin');
Route::post('pcolor', 'AdminController@addpcolor')->middleware('adminLogin');

Route::get('coso', 'AdminController@coso')->middleware('adminLogin');
Route::get('coso/{idcs}', 'AdminController@delcoso')->middleware('adminLogin');
Route::post('pcoso', 'AdminController@addpcoso')->middleware('adminLogin');

Route::get('hoahong', 'AdminController@hoahong')->middleware('adminLogin');
Route::post('phoahong', 'AdminController@savehoahong')->middleware('adminLogin');


//history
Route::get('history', 'HistoryController@history')->middleware('adminLogin');
//bưu điện
Route::get('post', 'BuudienController@post')->middleware('adminLogin');
Route::get('post/{squirrel}/{any}', 'BuudienController@checkbox');
Route::get('post1/{squirrel}/{any}', 'BuudienController@checkbox1');

Route::get('report', 'Auth\ReportController@report')->middleware('adminLogin');
Route::post('import', 'Auth\ReportController@import')->middleware('adminLogin');
Route::get('export', 'Auth\ReportController@export')->middleware('adminLogin');

//khách hàng
Route::get('khachhang', 'KhachhangController@khachhang')->middleware('adminLogin');
Route::get('ajaxRead', 'KhachhangController@ajaxRead')->middleware('adminLogin');
Route::get('khachhang/{id_kh}', 'KhachhangController@ekhachhang')->middleware('adminLogin');
Route::post('pkhachhang/{id_kh}', 'KhachhangController@pkhachhang')->middleware('adminLogin');
//đơn shiper
Route::get('donship', 'UsersController@donhangship')->middleware('adminLogin');

//json
Route::get('test', 'UsersController@test');
Route::get('json_dh', 'UsersController@json_dh');
Route::get('jsodon', 'UsersController@json_donship');
//autocomplete
Route::get('autocomplete',array('as'=>'autocomplete','uses'=>'SanphamController@autocomplete'));
Route::get('autocompletephone',array('as'=>'autocompletephone','uses'=>'SanphamController@autocompletephone'));


Route::get('/markAsRead',function(){
    auth()->user()->unreadNotifications->markAsRead()->middleware('adminLogin');
});
Route::post('/notification/get', 'NotificationController@get')->middleware('adminLogin');
Route::post('/notification/read', 'NotificationController@read')->middleware('adminLogin');
Route::get('notiship', 'UsersController@notiship');
Route::post('apiupdate', 'RequestController@update');

Route::get('messages', 'ChatsController@fetchMessages');
Route::post('messages', 'ChatsController@sendMessage');