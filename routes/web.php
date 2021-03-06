<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDashboardCountController;
use App\Http\Controllers\AdminDataTablesController;
use App\Http\Controllers\AppFormController;
use App\Http\Controllers\ApplicationFormController;
use App\Http\Controllers\ApplicationFormPdfController;
use App\Http\Controllers\passwordChangeController;
use App\Http\Controllers\ReUploadController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\ApplicationForm;
use GuzzleHttp\Middleware;

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

Route::get('/','App\Http\Controllers\pagesController@index');


// Route::get('/register','App\Http\Controllers\pagesController@register');
// Route::post('/register','App\Http\Controllers\Auth\RegisterController@create')->name('register');

// Route::get('/login','App\Http\Controllers\pagesController@login')->name('login');

//Route::get('/login','App\Http\Controllers\pagesController@login');

Route::get('/advanceDiploma','App\Http\Controllers\pagesController@advanceDiploma');
Route::get('/adit','App\Http\Controllers\pagesController@adit');
Route::get('/cits','App\Http\Controllers\pagesController@cits');
Route::get('/mechanicAc','App\Http\Controllers\pagesController@mechanicAc');
Route::get('/readingOfDrawing','App\Http\Controllers\pagesController@readingOfDrawing');
Route::get('/electricianAndWireman','App\Http\Controllers\pagesController@electricianAndWireman');
Route::get('/electronicMechanic','App\Http\Controllers\pagesController@electronicMechanic');
Route::get('/welder','App\Http\Controllers\pagesController@welder');

Route::get('/about','App\Http\Controllers\pagesController@about');
Route::get('/contact','App\Http\Controllers\pagesController@contact');
Route::get('/ctsnewagecourse','App\Http\Controllers\pagesController@ctsnewagecourse');
Route::get('/electrician','App\Http\Controllers\pagesController@electrician');
Route::get('/iot','App\Http\Controllers\pagesController@iot');

Route::get('/solar','App\Http\Controllers\pagesController@solar');

Route::get('/team','App\Http\Controllers\pagesController@team');








Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('testReq',[ApplicationFormController::class,'testRequest'])->middleware('isUser');
Route::get('getDocForReUpload',[ApplicationFormController::class,'getDocReUpload'])->middleware('isUser');


//Change password
Route::post('updatePassword',[passwordChangeController::class,'changePassword']);

// Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){

//     Route::get('dashboard',[AdminController::class,'index'])->name('admin.dashboard');
//     Route::get('profile',[AdminController::class,'profile'])->name('admin.profile');
//     Route::get('dashboard',[AdminController::class,'settings'])->name('admin.settings');

// });


// Route::group(['prefix'=>'user','middleware'=>'auth'],function(){

//     Route::get('dashboard',[UserController::class,'index'])->name('user.dashboard');
//     Route::get('profile',[UserController::class,'profile'])->name('user.profile');
//     Route::get('dashboard',[UserController::class,'settings'])->name('user.settings');

// });



//AdminRouteGroup
Route::group(['prefix'=>'admin', 'middleware'=>['isAdmin','auth','PreventBackHistory']],function(){

    Route::get('dashboard',[AdminController::class,'index'])->name('admin.dashboard');
    Route::get('profile',[AdminController::class,'profile'])->name('admin.profile');
    Route::get('settings',[AdminController::class,'settings'])->name('admin.settings');


});

//Dashboard Count
Route::get('totalApp',[AdminDashboardCountController::class,'totalCount'])->Middleware('isAdmin');


Route::get('getEducation/{id}',[AdminDataTablesController::class,'educationGet']);
Route::get('getExperience/{id}',[AdminDataTablesController::class,'experienceGet']);
Route::get('getDocs/{id}',[AdminDataTablesController::class,'docsGet']);

Route::get('exportApplication',[ApplicationFormPdfController::class,'getDataPdf']);

Route::get('getDocsForReUpload/{id}',[AdminDataTablesController::class,'docsGetReUpload']);

//admit
Route::post('admitStudents/{id}',[AdminDataTablesController::class,'admit'])->middleware('isAdmin');
//Reject
Route::post('rejectStudents/{id}',[AdminDataTablesController::class,'reject'])->middleware('isAdmin');
//waiting
Route::post('addWaiting/{id}',[AdminDataTablesController::class,'waitingList'])->middleware('isAdmin');

//admittedList-main
Route::post('admittedStudents',[AdminDataTablesController::class,'admittedList'])->middleware('isAdmin');
//WaitingList
Route::post('waitingListStudents',[AdminDataTablesController::class,'waiting'])->middleware('isAdmin');
Route::post('TableDataWaitingListForExport',[AdminDataTablesController::class,'waitingListForExport'])->middleware('isAdmin');

//RekjectedList
Route::post('rejectedStudents',[AdminDataTablesController::class,'rejectListShow'])->middleware('isAdmin');
Route::post('TableDataRejectedListForExport',[AdminDataTablesController::class,'rejectedListForExport'])->middleware('isAdmin');

//Adit Admitted
Route::post('aditAdmitted',[AdminDataTablesController::class,'aditAdmittedList'])->middleware('isAdmin');
Route::post('aditAdmittedForExport',[AdminDataTablesController::class,'aditAdmittedListExport'])->middleware('isAdmin');

//CITS R and AC Admitted
Route::post('RandAcAdmitted',[AdminDataTablesController::class,'RandAcAdmittedList'])->middleware('isAdmin');
Route::post('RandAcAdmittedForExport',[AdminDataTablesController::class,'RandAcAdmittedListExport'])->middleware('isAdmin');

//CITS RODA Admitted
Route::post('ReadingOfDrawingAdmittedList',[AdminDataTablesController::class,'ReadingOfDrawingAdmittedListShow'])->middleware('isAdmin');
Route::post('RodaForExport',[AdminDataTablesController::class,'RodaExport'])->middleware('isAdmin');

//CITS elctrician and wireman Admitted
Route::post('ElectricianWiremanAdmittedList',[AdminDataTablesController::class,'ElectricianWiremanAdmittedListShow'])->middleware('isAdmin');
Route::post('ElectricianWiremanForExport',[AdminDataTablesController::class,'ElectricianWiremanForExportList'])->middleware('isAdmin');

//CITS Electronic Mechanic Admitted
Route::post('ElectronicMechanicAdmittedList',[AdminDataTablesController::class,'ElectronicMechanicAdmittedListShow'])->middleware('isAdmin');
Route::post('ElectronicMechanicExport',[AdminDataTablesController::class,'ElectronicMechanicExportList'])->middleware('isAdmin');

//CITS Welder Admitted
Route::post('WelderAdmittedList',[AdminDataTablesController::class,'WelderAdmittedListShow'])->middleware('isAdmin');
Route::post('WelderAdmittedForExport',[AdminDataTablesController::class,'WelderAdmittedForExportList'])->middleware('isAdmin');

//Solar Technician Admitted
Route::post('SolarTechnicianAdmitted',[AdminDataTablesController::class,'SolarTechnicianAdmittedList'])->middleware('isAdmin');
Route::post('SolarTechnicianAdmittedExport',[AdminDataTablesController::class,'SolarTechnicianAdmittedExportList'])->middleware('isAdmin');

//IOT  Admitted
Route::post('IotAdmittedList',[AdminDataTablesController::class,'IotAdmittedListShow'])->middleware('isAdmin');
Route::post('iotAdmittedForExport',[AdminDataTablesController::class,'iotAdmittedForExportList'])->middleware('isAdmin');

//ElectricianPowerDistributionList  Admitted
Route::post('ElectricianPowerDistributionList',[AdminDataTablesController::class,'ElectricianPowerDistributionListShow'])->middleware('isAdmin');
Route::post('ElectricianPowerDisForExport',[AdminDataTablesController::class,'ElectricianPowerDisForExportList'])->middleware('isAdmin');

//all-studentsList
Route::post('GetLoadAllUsers',[AdminDataTablesController::class,'allStudents'])->middleware('isAdmin');
Route::post('GetAllDataForExport',[AdminDataTablesController::class,'allStudentsExport'])->middleware('isAdmin');

Route::post('TableData',[AdminDataTablesController::class,'showData'])->middleware('isAdmin');
Route::post('TableDataForExcelExport',[AdminDataTablesController::class,'showDataForExcelExport'])->middleware('isAdmin');

Route::post('certVerify/{id}',[AdminDataTablesController::class,'certVerify'])->middleware('isAdmin');
Route::post('certReject/{id}',[AdminDataTablesController::class,'certReject'])->middleware('isAdmin');

Route::post('TableDataAdmission',[AdminDataTablesController::class,'TableDataForAdmission'])->middleware('isAdmin');
Route::post('TableDataAdmissionForExport',[AdminDataTablesController::class,'showDataForAdmissionExport'])->middleware('isAdmin');

Route::post('TableDataAdmittedForExport',[AdminDataTablesController::class,'admittedStudentsExport'])->middleware('isAdmin');



Route::post('feeVerify/{id}',[AdminDataTablesController::class,'feeVerify'])->middleware('isAdmin');
Route::post('feeReject/{id}',[AdminDataTablesController::class,'feeReject'])->middleware('isAdmin');


Route::post('postAppFormData',[ApplicationFormController::class,'saveData']);
Route::get('getFormNextStatus',[ApplicationFormController::class,'getFormStatus']);


Route::post('postEducations',[ApplicationFormController::class,'postEducations']);
Route::post('upCertPhoto',[ApplicationFormController::class,'upCertPhoto']);
Route::post('postExperience',[ApplicationFormController::class,'postExperience']);

Route::post('checkFinalValues',[ApplicationFormController::class,'checkValuesFinalSubmit'])->middleware('isUser');
Route::post('changeFormStatus',[ApplicationFormController::class,'changeStatusFinalSubmit'])->middleware('isUser');
Route::post('changeReupRemarks',[ApplicationFormController::class,'reUpRemarksChangeBack'])->middleware('isUser');



//21-06-21FilesUpload
Route::post('uploadCandidatePhoto',[ApplicationFormController::class,'upCPhoto']);
Route::post('uploadaadharFrontPhoto',[ApplicationFormController::class,'upAadharF']);
Route::post('uploadaadharBackPhoto',[ApplicationFormController::class,'upAadharB']);

//reupload documents
Route::post('reUploadCandidatePhoto',[ReUploadController::class,'reUpCPhoto'])->middleware('isUser');
Route::post('reUploadaadharBackPhoto',[ReUploadController::class,'reUpAadharB'])->middleware('isUser');
Route::post('reUploadaadharFrontPhoto',[ReUploadController::class,'reUpAadharF'])->middleware('isUser');


//UserRouteGroup
Route::group(['prefix'=>'user','middleware'=>['isUser' ,'auth','PreventBackHistory']],function(){

    Route::get('dashboard',[UserController::class,'index'])->name('user.dashboard');
    Route::get('profile',[UserController::class,'profile'])->name('user.profile');
    Route::get('settings',[UserController::class,'settings'])->name('user.settings');


    Route::get('getdoc',[ApplicationFormController::class,'getDoc'])->middleware('isUser');



});

Route::post('postdoc',[ApplicationFormController::class,'postDoc'])->middleware('isUser');

Route::post('rePostdoc',[ReUploadController::class,'PostDocReUp'])->middleware('isUser');












// //for vue path refresh--------BUG 15-06-2021
Route::get('{path}',[AdminController::class,'index'])->where( 'path', '.*' )->middleware('isAdmin');




