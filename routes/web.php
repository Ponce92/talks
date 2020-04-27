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


Route::get('/logout','Auth\LoginController@logout')->name('logout');
Route::post('/login','Auth\LoginController@login')->name('login');
//Route::get('/dashboard','Publico\HomeController@showDashboard')->name('dashboard');

/**
 * Tipos: /public/....
 * Descripcion: Rutas accesibles a usuario no registrados del sistema..
 */


Route::get('/',function (){
    return redirect('login/');
});

Route::get('public/','HomeController@showHome')->name('home');
Route::get('login','HomeController@showLogin')->name('showLogin')->middleware('guest');

/** Seccion : Rutas de administracion
 *  Descripcion:
 *  Author : Azael Ponce
 */
Route::group(['middleware'=>'auth'],function(){
    Route::get('dashboard','Publico\HomeController@showDashboard')->name('dashboard');
    Route::resource('private/admin/roles','Protegido\RolController');

    Route::get('roles/get/list','Protegido\RolController@getList')->name('roles.get.list');
    Route::resource('protected/resources/permissions','Protegido\PermissionController');

    Route::get('/private/admin/rolpermisions/{idRol}','Protegido\RolPermisionsController@index')->name('rolPermisions');
    Route::post('/private/admin/rolpermisions/update/','Protegido\RolPermisionsController@update')->name('update.rol.permisions');


    Route::resources([
        'protected/users'=>'Protegido\UserController',
        'protected/groups'=>'Protegido\GropController'
    ]);


    /**
     * Rutas del modulo de administracion de planilla...
     */
    Route::resources([
        'payroll/departments'=>'Payroll\DepartmentController',
        'payroll/job'=>'Payroll\JobController',
        'payroll/employees'=>'Payroll\EmployeeController',
        'payroll/positions'=>'Payroll\PositionController',
        'payroll/jobs'=>'Payroll\JobController',
        'payroll/persons'=>'Payroll\PersonController'
    ]);

    Route::get('payroll/departments/get/positions/{id}','Payroll\DepartmentController@getPositions')->name('getPositions');
    Route::get('payroll/departments/get/positions/related/{id}','Payroll\DepartmentController@getPositionsRelated')->name('getPositionsRelated');
    Route::post('payroll/departments/post/positions','Payroll\DepartmentController@addPosition')->name('addPositions');


    Route::get('payroll/departments/get/jobs/{id}','Payroll\DepartmentController@getJobs')->name('jobsSummary');
    Route::post('payroll/jobs/positions/','Payroll\JobController@getPositions')->name('getJobsPost');
    Route::get('payroll/employee/only/edit/{id}','Payroll\EmployeeController@getOnlyEmployee')->name('employeeOnly');
});




