<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    return redirect('home');
})->middleware('admin');
Route::get('/home', 'HomeController@index')->name('home')->middleware('admin');
Route::get('/messenger', 'HomeController@messanger')->middleware('secondadmin');
Route::get('/profile', 'HomeController@profile')->middleware('admin');
Route::get('/users', function(){
    return redirect('/list/users');
})->middleware('secondadmin');
Route::get('/news', 'HomeController@news')->middleware('secondadmin');
Route::get('/users/permissions', 'AdminController@permissions')->middleware('secondadmin');
Route::get('/project/{token}','UserController@displayproject')->middleware('admin');
Route::get('/task/{access_token}','UserController@displaytask')->middleware('admin');

Route::group(['prefix'=>'list'], function(){
  Route::get('/alltasks', 'AdminController@alltasks')->middleware('secondadmin');
  Route::get('/mytasks','UserController@mytasks')->middleware('admin');
  Route::get('/finishedtasks','UserController@finishedtasks')->middleware('admin');
  Route::get('/tasks-in-progress','UserController@gettasksinprogress')->middleware('admin');
  Route::get('/all-finished-tasks','AdminController@allfinishedtasks')->middleware('secondadmin');
  // Task end here
  Route::get('/ideas','UserController@getideas')->middleware('secondadmin');
  Route::get('/projects','AdminController@displayallprojects')->middleware('secondadmin');
  Route::get('/myprojects','AdminController@displaymyprojects')->middleware('admin');
  // Project End here
  Route::get('/positions','AdminController@userpositions')->middleware('secondadmin');
  Route::get('/users','HomeController@users')->middleware('secondadmin');
});

Route::group(['prefix'=>'add'], function(){
  Route::get('/sendidea','UserController@sendidea')->middleware('admin');
  Route::post('/sendidea','UserController@sendideato')->middleware('admin');
  // idea end here
  Route::get('/user','AdminController@adduser')->middleware('secondadmin');
  Route::post('/user','AdminController@toadduser')->middleware('secondadmin');
  // user end here
  Route::get('/project','AdminController@addproject')->middleware('secondadmin');
  Route::post('/newproject','AdminController@createproject')->middleware('secondadmin');
  // project end here
  Route::get('/task','AdminController@addtask')->middleware('secondadmin');
  Route::post('/newtask','AdminController@addnewtask')->middleware('secondadmin');
  // Task end here
  Route::get('/country','AdminController@countries')->middleware('secondadmin');
  Route::post('/country','AdminController@addcountry')->middleware('secondadmin');
  Route::post('/position','AdminController@addposition')->middleware('secondadmin');
});
Route::group(['prefix'=>'update'], function(){
  Route::get('permissions', 'AdminController@updatepermissions')->middleware('secondadmin');
  Route::post('/position/{id}','AdminController@updateposition')->middleware('secondadmin');
  Route::post('/password/{id}','UserController@changepassword')->middleware('admin');
  Route::post('/userdata/{id}', 'UserController@changeuserdata')->middleware('admin');
  Route::post('/task/edit/{id}','TaskController@updatepercentage')->middleware('admin');
  Route::post('/task/edittitle/{id}','TaskController@changetasktitle')->middleware('secondadmin');
  Route::post('/task/editstart_date/{id}','TaskController@changetaskstart_date')->middleware('secondadmin');
  Route::post('/task/editdeadline/{id}','TaskController@changetaskdeadline')->middleware('secondadmin');
  Route::post('/task/editdetails/{id}','TaskController@changetaskdetails')->middleware('secondadmin');
  Route::post('/task/editstatus/{id}','TaskController@changestatus')->middleware('admin');
  Route::post('/task/editrelpro/{id}','TaskController@changerelatedproject')->middleware('admin');
  Route::post('/profilephoto/{id}','UserController@changeprofilephoto')->middleware('admin');
});
Route::group(['prefix'=>'edit'], function(){
  Route::post('/password/{id}','AdminController@resetpassword')->middleware('secondadmin');
  Route::post('/userpermission/{id}','AdminController@userpermission')->middleware('secondadmin');
});
Route::group(['prefix'=>'delete'], function(){
  Route::get('/task/{id}','AdminController@deletetask')->middleware('secondadmin');
  Route::get('/project/{id}','AdminController@deleteproject')->middleware('secondadmin');
  Route::get('/employee/{id}','AdminController@deleteuser')->middleware('secondadmin');
  Route::get('/idea/{id}','AdminController@deleteidea')->middleware('secondadmin');
  Route::post('/profilephoto/{id}','UserController@deleteprofilephoto')->middleware('admin');
});


Auth::routes();
