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

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('/userhome',[
    'uses' => 'UserController@index',
    'as'  => 'userhomepage'
]);

Route::get('/adminhome',[
    'uses' => 'AdminController@index',
    'as'  => 'adminhomepage'
]);

Route::post('/userlogincheck',[
    'uses'  =>  'UserController@checkLogIn',
    'as'    =>  'checkinguserlogin'
]);


Route::get('/user',[
    'uses'  =>  'UserController@successfullyLoggedIn',
    'as'    =>  'userdashboard',
    'middleware' => 'auth'
]);

Route::post('/user/exam',[
    'uses' => 'QuestionController@giveExam',
    'as' => 'givingexam',
    'middleware' => 'auth'
]);

Route::post('/user/exam/{id}',[
    'uses' => 'QuestionController@saveQuestionResult',
    'as' => 'savequestions',
    'middleware' => 'auth'
]);

Route::get('/user/exam','UserController@wrong_page');

Route::get('/userregister',[
    'uses'   => 'UserController@register',
    'as'    => 'registering_user'
]);

Route::get('/feedback',[
    'uses' => 'UserController@giveFeedback',
    'as' => 'userfeedback'
]);

Route::post('/feedback/checkdata',[
    'uses' => 'UserController@checkFeedback',
    'as' => 'checkingFeedback'
]);

Route::post('/userregistercheck',[
    'uses'  => 'UserController@checkregistration',
    'as'    => 'user_r_check'
]);

Route::get('/userregistercheck', 'UserController@wrong_page');
Route::get('/userlogincheck', 'UserController@wrong_page');
//Route::get('/superadmin', 'UserController@wrong_page');
Route::get('/adminregistercheck', 'UserController@wrong_page');
Route::get('/adminlogincheck', 'UserController@wrong_page');

Route::get('/ulogout',[
    'uses'   => 'UserController@logout',
    'as'    => 'ulog_out',
    'middleware' => 'auth'
]);

Route::get('/alogout',[
    'uses'   => 'AdminController@logout',
    'as'    => 'alog_out',
    'middleware' => 'auth:admin'
]);

Route::get('/admin',[
    'uses'  =>  'AdminController@successfullyLoggedIn',
    'as'    =>  'admindashboard',
'middleware' => 'auth:admin'
]);


Route::post('/adminlogincheck',[
    'uses'  => 'AdminController@checkLogIn',
    'as'    => 'checkingadminlogin'
]);

Route::get('/admin/userlist', [
    'uses' => 'AdminController@getuserlist',
    'as' => 'user_list',
  'middleware' => 'auth:admin'
]);


Route::post('/register/email_available/check', 'AdminController@checkEmailAvailablity')->name('checkaemailavailable');

Route::get('/admin/userlist/changeusersflag/{id}', 'AdminController@changeFlagendis')->name('changeflag');

Route::post('/adminregistercheck',[
    'uses'  => 'AdminController@checkregistration',
    'as'    => 'admin_r_check'
]);




Route::get('/adminregister',[
    'uses'   => 'AdminController@register',
    'as'    => 'registering_admin'
]);

Route::get('/password',[
    'uses'  => 'SuperAdminController@password',
    'as'    => 'pass'
]);

Route::post('/checkpasswordlogin',[
    'uses' => 'SuperAdminController@checkPasswordLogin',
    'as'    => 'masteradmin'
]);

Route::get('/superadmin',[
    'uses'  => 'SuperAdminController@index',
    'as'    => 'super_admin',
    'middleware' => 'auth:superadmin'
]);

Route::get('/slogout',[
    'uses'   => 'SuperAdminController@logout',
    'as'    => 'slog_out',
    'middleware' => 'auth:superadmin'
]);

Route::post('/superadmin/verificationcode',[
    'uses' => 'SuperAdminController@addVerificationCode',
    'as' => 'addverifycode',
    'middleware' => 'auth:superadmin'
]);

Route::get('/admin/adminaccountdetails',[
    'uses' => 'AdminController@accountDetails',
    'as' => 'detailaboutaaccount',
    'middleware' => 'auth:admin'
]);

Route::get('/user/useraccountdetails',[
    'uses' => 'UserController@accountDetails',
    'as' => 'detailaboutuaccount',
    'middleware' => 'auth'
]);


Route::get('/superadmin/superadminaccountdetails',[
    'uses' => 'SuperAdminController@accountDetails',
    'as' => 'detailaboutsaccount',
    'middleware' => 'auth:superadmin'
]);

Route::post('/admin/addcategory',[
    'uses' => 'AdminController@addCategory',
    'as' => 'add_category',
    'middleware' => 'auth:admin'
]);

Route::post('/admin/addsubject',[
    'uses' => 'AdminController@addSubject',
    'as' => 'add_subject',
    'middleware' => 'auth:admin'
]);

Route::get('/admin/viewprofile',[
    'uses' => 'AdminController@viewAdminProfile',
    'as' => 'viewingadminprofile',
    'middleware' => 'auth:admin'
]);

Route::get('/user/viewprofile',[
    'uses' => 'UserController@viewUserProfile',
    'as' => 'viewinguserprofile',
    'middleware' => 'auth'
]);

Route::get('/superadmin/viewprofile',[
    'uses' => 'SuperAdminController@viewSuperAdminProfile',
    'as' => 'viewingsuperadminprofile',
    'middleware' => 'auth:superadmin'
]);

Route::get('/verify/{token}', 'AdminController@verifyAdmin'); //code that will be executed when admin clicks link send to his email

Route::get('/recoverpassword/{email}/{token}',[
    'uses' => 'AdminController@verifyForgotPasswordLink',
    'as' => 'abcrecoverpassword'
]);


Route::post('/admin/managecategoryandsubject',[
    'uses' => 'AdminController@manageCategoryandSubject',
    'as' => 'manage_categoryansubject',
    'middleware' => 'auth:admin'
]);

Route::get('/user/deleteaccount',[
    'uses' => 'UserController@deleteAccount',
    'as' => 'udelete_account',
    'middleware' => 'auth'
]);


Route::get('/admin/deleteaccount',[
    'uses' => 'AdminController@deleteAccount',
    'as' => 'adelete_account',
    'middleware' => 'auth:admin'
]);

Route::get('/admin/managequestion/{id}',[
    'uses' => 'QuestionController@manageQuestion',
    'as' => 'question_managing',
    'middleware' => 'auth:admin'
]);

Route::get('/admin/deletesubject/{id}',[
    'uses' => 'QuestionController@deleteSubject',
    'as' => 'delete_subject',
    'middleware' => 'auth:admin'
]);

Route::get('/admin/subjectactivestatus/{id}',[
    'uses' => 'QuestionController@changeActiveStatus',
    'as' => 'changesubjectactivestatus',
    'middleware' => 'auth:admin'
]);

Route::post('/admin/addnewquestion/{id}',[
    'uses' => 'QuestionController@addQuestion',
    'as' => 'adding_ques',
    'middleware' => 'auth:admin'
]);

Route::get('/admin/deletequestion/{id}',[
    'uses' => 'QuestionController@deleteQuestion' ,
    'as' => 'question_delete',
    'middleware' => 'auth:admin'
]);

Route::post('/admin/editquestion/{id}',[
    'uses' => 'QuestionController@editAddedQuestion' ,
    'as' => 'edit_addedquestion',
    'middleware' => 'auth:admin'
]);

Route::get('/superadmin/deleteverificationcode/{id}',[
    'uses' => 'SuperAdminController@deleteVerificationCode' ,
    'as' => 'deleteverificationcode',
    'middleware' => 'auth:superadmin'
]);

Route::get('/superadmin/changeadminsflag/{id}',[
    'uses' => 'SuperAdminController@changeAccountStatus',
    'as' => 'changeadminaccountflag',
    'middleware' => 'auth:superadmin'
]);

Route::get('/superadmin/viewfeedback',[
    'uses' => 'SuperAdminController@viewFeedback',
    'as' => 'viewfeedback',
    'middleware' => 'auth:superadmin'
]);

Route::get('user/changepassword',[
    'uses' => 'UserController@changePassword',
    'as' => 'changeupassword',
    'middleware' => 'auth'
]);

Route::get('admin/changepassword',[
    'uses' => 'AdminController@changePassword',
    'as' => 'changeapassword',
    'middleware' => 'auth:admin'
]);

Route::get('superadmin/changepassword',[
    'uses' => 'SuperAdminController@changePassword',
    'as' => 'changespassword',
    'middleware' => 'auth:superadmin'
]);


Route::post('user/changepassword/check',[
    'uses' => 'UserController@checkChangePassword',
    'as' => 'checkchangeupassword',
    'middleware' => 'auth'
]);

Route::post('admin/changepassword/check',[
    'uses' => 'AdminController@checkChangePassword',
    'as' => 'checkchangeapassword',
    'middleware' => 'auth:admin'
]);

Route::post('superadmin/changepassword/check',[
    'uses' => 'SuperAdminController@checkChangePassword',
    'as' => 'checkchangespassword',
    'middleware' => 'auth:superadmin'
]);


Route::get('/recoverpassword',[
'uses' => 'AdminController@forgotPassword',
    'as' => 'forgotpassword'
]);


Route::post('/recoverpassword/checkdetail',[
    'uses' => 'AdminController@checkForgotDetail',
    'as' => 'checkforgotpassword'
]);


Route::get('/recoverpassword/checkdetail','UserController@wrong_page');

Route::post('recoverpassword/changepassword/check/{email}/{name}',[
    'uses' => 'AdminController@checkRecoverChangePassword',
    'as' => 'checkrecoverPassword'
]);


Route::post('/admin/viewresult',[
    'uses' => 'AdminController@viewResult',
    'as' =>'viewresultadmin',
    'auth' => 'auth:admin'
]);





