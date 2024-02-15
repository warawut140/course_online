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

//Route::get('/welcome', function () {
//    return view('welcome');
//});


Route::get('/phpinfo', function () {
    phpinfo();
 });


Auth::routes();

Route::get('/', 'frontend\HomeController@index')->name('index');

Route::group(['middleware' => ['web','auth']], function () {
    Route::get('/register_company_detail/{type?}','frontend\RegisterFullController@register_company_detail');
    Route::get('/course_add','frontend\CourseNewController@course_add');
    Route::post('/course_store','frontend\CourseNewController@course_store');
    Route::get('/course_view/{id}','frontend\CourseNewController@course_view');

    Route::get('/chapter_add/{c_id}','frontend\CourseNewController@chapter_add');
    Route::post('/chapter_store','frontend\CourseNewController@chapter_store');
    Route::get('/chapter_view/{id}','frontend\CourseNewController@chapter_view');
    Route::post('/course_list_store','frontend\CourseNewController@course_list_store');
    Route::post('/course_list_remove_video','frontend\CourseNewController@course_list_remove_video');

    Route::get('/workshop_add/{chapter_id}','frontend\CourseNewController@workshop_add');
    Route::post('/workshop_store','frontend\CourseNewController@workshop_store');
    Route::get('/workshop_view/{chapter_id}/{workshop_id}','frontend\CourseNewController@workshop_view');
    Route::post('/question_store','frontend\CourseNewController@question_store');

    Route::get('/job_add','frontend\JobNewController@job_add');
    Route::post('/job_store','frontend\JobNewController@job_store');
    Route::get('/job_view/{id}','frontend\JobNewController@job_view');
    Route::get('/job_delete/{id}','frontend\JobNewController@job_delete');
    Route::post('/register_company_detail_basic_store','frontend\RegisterFullController@register_company_detail_basic_store');

    Route::get('/course_online_view/{course_id}','frontend\CourseNewController@course_online_view');
    Route::get('/course_online_inside_view/{course_list_id}','frontend\CourseNewController@course_online_inside_view');

    Route::get('/workshop_inside_view/{course_id}/{workshop_id}','frontend\CourseNewController@workshop_inside_view');
    Route::post('/workshop_inside_store','frontend\CourseNewController@workshop_inside_store');
    Route::get('/getDownload/{type}/{name}','frontend\CourseNewController@getDownload');

    Route::get('/workshop_inside_check/{question_detail_id}','frontend\CourseNewController@workshop_inside_check');

    Route::get('/workshop', function () {
        return view('frontend/workshop');
     });

     Route::get('worklist_detail/{job_id}', 'frontend\JobNewController@worklist_detail');
     Route::get('worklist_detail_register/{job_id}', 'frontend\JobNewController@worklist_detail_register');
     Route::post('worklist_detail_register_store', 'frontend\JobNewController@worklist_detail_register_store');

    // Route::get('/course_online', function () {
    //     return view('frontend/course_online');
    //  });
    //  Route::get('/course_online_inside', function () {
    //     return view('frontend/course_online_inside');
    //  });

    // Route::get('/certificate_dowload/{id}','frontend\CourseNewController@course_view');
    Route::get('/register_user_detail/{type?}','frontend\RegisterFullController@register_user_detail');
    Route::post('/register_student_detail_basic_store','frontend\RegisterFullController@register_student_detail_basic_store');

    Route::get('/profile_student/{page?}','frontend\ProfileNewController@profile_student');
    Route::get('/profile_company/{page?}','frontend\ProfileNewController@profile_company');
    Route::get('/certificate_print/{c_id}/{u_id}/{cl_id}/{qd_id}','PDFController@certificate_print');


});
Route::post('/register_full','frontend\RegisterFullController@register');

 Route::get('/worklist', 'frontend\HomeController@worklist');
//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/index', 'frontend\HomeController@index')->name('index');
Route::resource('/work', 'frontend\WorkController');
Route::post('/addCommentWork','frontend\WorkController@addComment');
Route::get('/mgmt-work/{id}','frontend\WorkController@mgmtWork');
Route::get('autocomplete/user', 'frontend\WorkController@search');
Route::post('/add/mgmt-work','frontend\WorkController@addMgmtWork');
Route::get('/approve-work/{wp_id}/{id}','frontend\WorkController@approveWork');
Route::post('/approve/work','frontend\WorkController@addApprove');
Route::get('/apiMgmtWork/{id}','frontend\WorkController@getApiMgmtWork');
Route::get('/apiUpdateWork/{id}','frontend\WorkController@getUpdateWork');
Route::get('/apiDeleteWork/{id}','frontend\WorkController@getDeleteWork');
Route::post('/searchWork/','frontend\WorkController@searchWork');
Route::resource('/projectauction', 'frontend\ProjectAuctionController');
Route::resource('/quotation', 'frontend\QuotationController');
Route::get('/quotation/dashboard/{id}', 'frontend\QuotationController@dashboard');
Route::post('/saveQuick', 'frontend\QuotationController@saveQuick');
Route::get('/quotation/contract/{id}', 'frontend\QuotationController@contract');
Route::get('/quotation/excel/{user_id}/{project_id}', 'frontend\QuotationController@generateExcel');
Route::get('/quotation/pdf/{user_id}/{project_id}', 'frontend\QuotationController@generatePDF');
Route::resource('/quotationPercentage', 'frontend\QuotationPercentageController');
//Route::get('/quotation/{id}', 'frontend\ProjectAuctionController@quotation');
Route::resource('/training', 'frontend\TrainingController');
Route::post('/searchTraining', 'frontend\TrainingController@searchTraining');
Route::post('/training/storeComment', 'frontend\TrainingController@storeComment');
Route::resource('/course', 'frontend\CourseController');
Route::get('/course2/{id}', 'frontend\CourseController@show2');
Route::get('/course2/{id}/{list_id}', 'frontend\CourseController@show2_list');
Route::post('/searchCourse', 'frontend\CourseController@searchCourse')->name('searchCourse');
Route::get('/article-test/{id}', 'frontend\CourseController@articleTest');
Route::get('/unLockCourse/{course_id}', 'frontend\CourseController@unLockCourse');
Route::get('/unLockCourse2/{course_id}', 'frontend\CourseController@unLockCourse2');
Route::get('/articleTestAPI/{id}', 'frontend\CourseController@articleTestAPI');
Route::get('/answers/{id}', 'frontend\CourseController@checkCourseList');
Route::get('/countArticleTestAPI/{id}', 'frontend\CourseController@countArticleTestAPI');
Route::resource('/suggest', 'frontend\SuggestController');
Route::post('/suggest/storeComment', 'frontend\SuggestController@storeComment');
Route::get('/suggest/delete/{$id}', 'frontend\SuggestController@destroy');
Route::get('/howtouse', 'frontend\HowtouseController@index');
Route::resource('/payment', 'frontend\PaymentController');
Route::get('/payment-credit', 'frontend\PaymentController@paymentCredit');
Route::post('responseurl', 'frontend\PaymentController@responseurl');

Route::resource('/promotion', 'frontend\PromotionController');
Route::get('/condition', 'frontend\ConditionController@index');
Route::get('/privacy-policy', 'frontend\PrivacyPolicyController@index');
Route::get('/faq', 'frontend\FaqController@index');
//Route::get('/profile', 'frontend\ProfileController@index');
Route::resource('/profile', 'frontend\ProfileController');

// Route::get('/interes_course', function () {
//    return view('frontend/interes_course');
// });

Route::get('/interes_course/','frontend\RegisterFullController@interes_course');
Route::get('/findjob/','frontend\RegisterFullController@findjob');

//  Route::get('/findjob', function () {
//     return view('frontend/findjob');
//  });

Route::get('/chat', 'ChatController@index')->name('chat');
Route::get('/chat/{id}', 'ChatController@chat');
Route::get('/message/{id}', 'ChatController@getMessage')->name('message');
Route::post('message', 'ChatController@sendMessage');

;

Route::post('/search', 'frontend\HomeController@search');
Route::resource('/mgmtContract', 'frontend\MgmtContractController');
Route::get('/mgmtContract/follow/{id}/{project_id}/{type}', 'frontend\MgmtContractController@follow');
Route::get('/mgmtContract/destroy/{id}', 'frontend\MgmtContractController@destroy');
Route::resource('/planner', 'frontend\PlannerController');
Route::get('/plannerUpdate/{id}/{project_id}', 'frontend\PlannerController@plannerUpdate');
Route::get('/jobUpdate/{project_id}', 'frontend\PlannerController@jobUpdate');

//ERP (ผู้จัดชื้อ)
Route::get('/erp-home', 'frontend\ErpBuyerController@erpHome');
Route::resource('/erpHome', 'frontend\ErpBuyerController');
Route::get('/erp-open', 'frontend\ErpBuyerController@erpOpen');
Route::get('/erp-listOrder', 'frontend\ErpBuyerController@erpListOrder');
Route::get('/erp-other', 'frontend\ErpBuyerController@erpOther');

//ERP (ร้านค้า)
Route::get('/erp-infoStore', 'frontend\ErpStoresController@erpInfoStore');
Route::get('/erpInfoStoreProduct/{id}', 'frontend\ErpStoresController@erpInfoStoreProduct');
Route::get('/erpEditStoreProduct/{id}', 'frontend\ErpStoresController@erpEditStoreProduct');
Route::get('/deleteProduct/{id}', 'frontend\ErpStoresController@deleteProduct');
Route::resource('/erpInfoStore', 'frontend\ErpStoresController');
Route::get('/erp-purchaseOrder', 'frontend\ErpStoresController@erpPurchaseOrder');
Route::get('/erp-install', 'frontend\ErpStoresController@erpInstall');
Route::get('/erp-service', 'frontend\ErpStoresController@erpService');
Route::get('/erp-priceSetup', 'frontend\ErpStoresController@erpPriceSetup');
Route::get('/erp-airProduct', 'frontend\ErpStoresController@erpAirProduct');


// Login google
Route::get('/auth/redirect', 'Auth\SocialAuthGoogleController@redirect');
Route::get('/auth/callback', 'Auth\SocialAuthGoogleController@callback');

Route::get('/addProfile', 'frontend\ProfileController@addProfile');
Route::post('/registerProfile', 'frontend\ProfileController@registerProfile')->name('registerProfile');


Route::get('/path/{id}', 'frontend\MessageController@path');


// GB PAY
Route::post('/registerProfile', 'frontend\ProfileController@registerProfile');



Route::prefix('admin')->group(function() {
    // Route::get('/', 'backend\AdminController@index')->name('admin.home');
    // Route::get('/home', 'backend\AdminController@index');
    Route::get('/', 'backend\StudentController@index')->name('admin.home');
    Route::get('/home', 'backend\StudentController@index');

    Route::get('/student', 'backend\StudentController@index');
    Route::get('/student/{id}/view', 'backend\StudentController@show');
    Route::post('/student_store', 'backend\StudentController@store');
    Route::get('/company', 'backend\CompanyController@index');
    Route::get('/company/{id}/view', 'backend\CompanyController@show');
    Route::post('/company_store', 'backend\CompanyController@store');

    Route::get('/banner', 'backend\WebSettingController@banner');
    Route::get('/banner/add', 'backend\WebSettingController@banner_add');
    Route::post('/banner/store', 'backend\WebSettingController@banner_store');
    Route::get('/banner/view/{id}', 'backend\WebSettingController@banner_view');

    Route::get('/display_course', 'backend\WebSettingController@display_course');
    Route::get('/display_course/view/{id}', 'backend\WebSettingController@display_course_view');
    Route::post('/display_course/store', 'backend\WebSettingController@display_course_store');

    Route::get('/display_work', 'backend\WebSettingController@display_work');
    Route::get('/display_work/view/{id}', 'backend\WebSettingController@display_work_view');
    Route::post('/display_work/store', 'backend\WebSettingController@display_work_store');

    Route::get('/course_type', 'backend\DataTypeController@course_type');
    Route::get('/course_type/add', 'backend\DataTypeController@course_type_add');
    Route::post('/course_type/store', 'backend\DataTypeController@course_type_store');
    Route::get('/course_type/{id}/delete', 'backend\DataTypeController@course_type_delete');
    Route::get('/course_type/{id}/view', 'backend\DataTypeController@course_type_view');

    Route::get('/work_type', 'backend\DataTypeController@work_type');
    Route::get('/work_type/add', 'backend\DataTypeController@work_type_add');
    Route::post('/work_type/store', 'backend\DataTypeController@work_type_store');
    Route::get('/work_type/{id}/delete', 'backend\DataTypeController@work_type_delete');
    Route::get('/work_type/{id}/view', 'backend\DataTypeController@work_type_view');

    Route::get('/work','backend\WorkListController@work');


    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout.submit');

//    Route::get('/admin', 'backend\AdminController@index');

    Route::resource('/air-conditioning','backend\AdminAirController');
    Route::get('/approve-air','backend\AdminAirController@approve');
    Route::get('/contract/{id}','backend\AdminAirController@contract');
    Route::get('/planner/{id}','backend\AdminAirController@planner');



    Route::resource('/training','backend\AdminTrainingController');
    Route::get('/training_edit/{id}','backend\AdminTrainingController@training_edit');
    Route::get('/training_delete/{id}','backend\AdminTrainingController@training_delete');
    Route::get('/training_com_delete/{id}','backend\AdminTrainingController@training_com_delete');
    Route::post('/training_update','backend\AdminTrainingController@training_update');
    Route::resource('/course','backend\AdminCourseController');
    Route::get('/course/delete/{id}','backend\AdminCourseController@destroy');
    Route::get('/course_chapter/{id}','backend\AdminCourseController@course_chapter');
    Route::post('/course_chapter/store','backend\AdminCourseController@course_chapter_store');
    Route::get('/course_chapter/{id}/delete','backend\AdminCourseController@course_chapter_delete');
    Route::get('/course_chapter/{id}/view','backend\AdminCourseController@course_chapter_view');
    //API
    Route::get('/getCourse','backend\AdminCourseController@getCourse');
    Route::get('/getCourseList/{id}','backend\AdminCourseController@getCourseList');
    Route::get('/getCourseID/{id}','backend\AdminCourseController@getCourseID');
    Route::get('/getCourseListID/{id}','backend\AdminCourseController@getCourseListID');
    Route::get('/delete/{id}','backend\AdminCourseController@delete');

    Route::resource('/courseTest','backend\AdminCourseTestController');
    Route::post('/courseTest_store','backend\AdminCourseTestController@store');
    Route::resource('/answers','backend\AdminAnswerController');
    Route::resource('/suggest','backend\AdminSuggestsController');
    Route::resource('/slide-banner','backend\AdminSlideBanner');
    Route::put('/slide-banner/update/{id}', 'backend\AdminSlideBanner@updateShow');
    Route::put('/slide-banner/update/hide/{id}', 'backend\AdminSlideBanner@updateHide');
    Route::resource('/promotion','backend\AdminPromotionController');
    Route::get('promotion/delete/{id}','backend\AdminPromotionController@destroy');

    //จัดการข้อมูลของ มาตรฐาน (ราคากลาง)
    Route::resource('/brands','backend\AdminBrandsController');
    Route::resource('/percents','backend\AdminPercentsController');
    Route::get('percentsData', 'backend\AdminPercentsController@percent');
    Route::resource('/standard ','backend\AdminPercentsController');
    Route::resource('/tags ','backend\AdminTagsController');
    Route::get('tags/delete/{id}','backend\AdminTagsController@destroy');
    Route::resource('/install-machine','backend\AdminInstallMachineController');
    Route::resource('/piping','backend\AdminPipingController');
    Route::resource('/control','backend\AdminControlController');
    Route::resource('/duct-piping','backend\AdminDuctPipingController');
    Route::resource('/main','backend\AdminMainController');
    Route::resource('/air-product','backend\AdminAirDataController');
    Route::get('/apiAirProduct','backend\AdminAirDataController@apiAirProduct');
    Route::get('/wire','backend\AdminProductController@wire');
    Route::get('/air-cleaners','backend\AdminProductController@airCleaners');
    Route::get('/pipe-wire','backend\AdminProductController@pipeWire');
    Route::get('/pvc','backend\AdminProductController@pvc');
    Route::get('/fiberglass-insulation','backend\AdminProductController@fiberglassInsulation');
    Route::get('/black-rubber-insulation','backend\AdminProductController@blackRubberInsulation');
    Route::get('/pvc-water-pipe','backend\AdminProductController@pvcWaterPipe');
    Route::get('/hdpe-waterwork','backend\AdminProductController@hdpeWaterwork');
    Route::get('/hdpe-electrical-work','backend\AdminProductController@hdpeElectricalWork');
    Route::get('/copper-tube','backend\AdminProductController@copperTube');
    Route::get('/flexible-duct','backend\AdminProductController@aeroduct');
    Route::get('/product-all','backend\AdminProductController@productAll');
    Route::resource('/product-item','backend\AdminProductController');
    Route::get('/apiWire','backend\AdminProductController@apiWire');
    Route::get('/apiAirCleaners','backend\AdminProductController@apiAirCleaners');
    Route::get('/apiPipeHotWire','backend\AdminProductController@apiPipeHotWire');
    Route::get('/apiRedDongPipes','backend\AdminProductController@apiRedDongPipes');
    Route::get('/apiFiberglassInsulation','backend\AdminProductController@apiFiberglassInsulation');
    Route::get('/apiBlackRubberInsulation','backend\AdminProductController@apiBlackRubberInsulation');
    Route::get('/apiPvc','backend\AdminProductController@apiPvc');
    Route::get('/apiPvcWaterPipe','backend\AdminProductController@apiPvcWaterPipe');
    Route::get('/apiHdpeWaterwork','backend\AdminProductController@apiHdpeWaterwork');
    Route::get('/apiHdpeElectricalWork','backend\AdminProductController@apiHdpeElectricalWork');
    Route::get('/apiCopperTube','backend\AdminProductController@apiCopperTube');
    Route::get('/apiAeroduct','backend\AdminProductController@apiAeroduct');
    Route::get('/apiProductAll','backend\AdminProductController@apiProductAll');
    Route::get('/showDetails/{type}/{id}','backend\AdminProductController@showDetails');
    Route::get('/deleteDetail/{id}','backend\AdminProductController@deleteDetail');
    Route::get('/deleteProduct/{type}/{id}','backend\AdminProductController@deleteProduct');
    Route::get('/apiSpecAir/{id}', 'backend\AdminAirDataController@apiSpecAir');
    Route::post('/saveSpecAir', 'backend\AdminAirDataController@saveSpecAir');
    Route::put('/updateSpecAir/{id}', 'backend\AdminAirDataController@updateSpecAir');

    //---- API มาตรฐาน (ราคากลาง)----//
    Route::resource('/data-standard','backend\AdminStandardController');
    Route::get('/getDropDownListSubjectWorks/{id}','backend\AdminStandardController@getDropDownListSubjectWorks');
    Route::get('/getDropDownListSubjectWorksType/{id}','backend\AdminStandardController@getDropDownListSubjectWorksType');
    Route::get('/getWork/{id}','backend\AdminStandardController@getWork');
    Route::get('/getSubJectWork/{id}','backend\AdminStandardController@getSubJectWork');
    Route::get('/getDropDownListWorks/{id}','backend\AdminStandardController@getDropDownListWorks');
    Route::get('/getTypeSubjectWorksList/{id}','backend\AdminStandardController@getTypeSubjectWorksList');
    Route::get('/getTypeSubjectWorks/{id}','backend\AdminStandardController@getTypeSubjectWorks');
    Route::get('/getDropDownListProduct/{id}','backend\AdminStandardController@getDropDownListProduct');
    Route::get('/getDataStandardList','backend\AdminStandardController@getDataStandardList');
    Route::post('/saveWork', 'backend\AdminStandardController@saveWork');
    Route::put('/updateWork/{id}', 'backend\AdminStandardController@updateWork');

    // Install Machine
    Route::get('/getDropDownListUnit','backend\AdminInstallMachineController@getDropDownListUnit');
    Route::get('/getDropDownListBrand','backend\AdminInstallMachineController@getDropDownListBrand');
    Route::get('/condensingUnit','backend\AdminInstallMachineController@condensingUnit');
    Route::get('/wallMount','backend\AdminInstallMachineController@wallMount');
    Route::get('/ceilingSuspended','backend\AdminInstallMachineController@ceilingSuspended');
    Route::get('/ceilingMountedDuct','backend\AdminInstallMachineController@ceilingMountedDuct');
    Route::get('/ceilingMountedCassette','backend\AdminInstallMachineController@ceilingMountedCassette');
    Route::get('/floorMounted','backend\AdminInstallMachineController@floorMounted');
    Route::get('/refnetJoint','backend\AdminInstallMachineController@refnetJoint');
    Route::get('/supportHanger','backend\AdminInstallMachineController@supportHanger');
    Route::get('/crane','backend\AdminInstallMachineController@crane');
    // Piping
    Route::get('/rpCopperPipeTypeL','backend\AdminPipingController@rpCopperPipeTypeL');
    Route::get('/rpPipeFittings','backend\AdminPipingController@rpPipeFittings');
    Route::get('/rpSupportHanger','backend\AdminPipingController@rpSupportHanger');
    Route::get('/rpRefrigerant','backend\AdminPipingController@rpRefrigerant');
    Route::get('/rpNytrogenTest','backend\AdminPipingController@rpNytrogenTest');
    Route::get('/rpAccessorries','backend\AdminPipingController@rpAccessorries');
    Route::get('/refrigerantPipeInsulation','backend\AdminPipingController@refrigerantPipeInsulation');
    Route::get('/rfpiAccessorries','backend\AdminPipingController@rfpiAccessorries');
    Route::get('/dpPvcPipeClass','backend\AdminPipingController@dpPvcPipeClass');
    Route::get('/dpPipeFittings','backend\AdminPipingController@dpPipeFittings');
    Route::get('/dpSupportHanger','backend\AdminPipingController@dpSupportHanger');
    Route::get('/dpInsulation','backend\AdminPipingController@dpInsulation');
    Route::get('/dpAccessorries','backend\AdminPipingController@dpAccessorries');
    //Control
    Route::get('/remote','backend\AdminControlController@remote');
    Route::get('/wiring','backend\AdminControlController@wiring');
    Route::get('/emt','backend\AdminControlController@emt');
    Route::get('/imc','backend\AdminControlController@imc');
    Route::get('/fittingAccessorries','backend\AdminControlController@fittingAccessorries');
    Route::get('/hangerSupports','backend\AdminControlController@hangerSupports');
    //Duct Piping

    Route::get('/galvanizedSteelSheet','backend\AdminDuctPipingController@galvanizedSteelSheet');
    Route::get('/insulationFiberglassFRK','backend\AdminDuctPipingController@insulationFiberglassFRK');
    Route::get('/hangerSupport','backend\AdminDuctPipingController@hangerSupport');
    Route::get('/smallMaterialsRainForceJoint','backend\AdminDuctPipingController@smallMaterialsRainForceJoint');
    Route::get('/insulationElastomerSheet','backend\AdminDuctPipingController@insulationElastomerSheet');
    Route::get('/sagSquare','backend\AdminDuctPipingController@sagSquare');
    Route::get('/roundDiffuser','backend\AdminDuctPipingController@roundDiffuser');
    Route::get('/jetFan','backend\AdminDuctPipingController@jetFan');
    Route::get('/lbgGrill','backend\AdminDuctPipingController@lbgGrill');
    Route::get('/linearSlotDiffuser','backend\AdminDuctPipingController@linearSlotDiffuser');
    Route::get('/singleDeflectionSupplyAirGrill','backend\AdminDuctPipingController@singleDeflectionSupplyAirGrill');
    Route::get('/dubleDeflectionSupplyAirGrill','backend\AdminDuctPipingController@dubleDeflectionSupplyAirGrill');
    Route::get('/returnAirGrill','backend\AdminDuctPipingController@returnAirGrill');
    Route::get('/servicePanel','backend\AdminDuctPipingController@servicePanel');
    Route::get('/chamber','backend\AdminDuctPipingController@chamber');

    Route::get('/mdb','backend\AdminMainController@mdb');
    Route::get('/lp','backend\AdminMainController@lp');
    Route::get('/circuitBreker','backend\AdminMainController@circuitBreker');
    Route::get('/electricalWireCable','backend\AdminMainController@electricalWireCable');
    Route::get('/acessories','backend\AdminMainController@acessories');
    Route::get('/conduitRaceway','backend\AdminMainController@conduitRaceway');
    Route::get('/fiitingAccessories','backend\AdminMainController@fiitingAccessories');
    Route::get('/hangerSupport','backend\AdminMainController@hangerSupport');
    Route::get('/safetySwitch','backend\AdminMainController@safetySwitch');
    Route::get('/isolateSwitch','backend\AdminMainController@isolateSwitch');

    //จัดการข้อมูลของ สมาชิกระบบ ss
    Route::resource('/user-member','backend\AdminMemberController');

});

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('clear-compiled');
    Artisan::call('config:cache');
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    return '<h1>cleared Success</h1>';
});
