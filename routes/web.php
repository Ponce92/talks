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

    Route::get('/private/user/permissions/{id}','Protegido\UserController@getPermission')->name('user.permisions');
    Route::post('/private/user/sync/permissions/{id}','Protegido\UserController@syncPermission')->name('sync.user.permisions');

    Route::get('/private/user/groups/{user}','Protegido\UserController@getGroups')->name('user.groups');
    Route::post('/private/user/sync/groups/{user}','Protegido\UserController@syncGroups')->name('sync.user.groups');


    Route::get('/private/groups/permissions/{group}','Protegido\GroupController@getPermissions')->name('group.permisions');
    Route::post('/private/groups/sync/permissions/{group}','Protegido\GroupController@syncPermissions')->name('sync.groups.permisions');

    Route::resources([
        'protected/users'=>'Protegido\UserController',
        'protected/groups'=>'Protegido\GroupController',
    ]);


    /**
     * Rutas del modulo de administracion de planilla...
     */
    Route::resources([
        'payroll/departments'=>'Payroll\DepartmentController',
        'payroll/employees'=>'Payroll\EmployeeController',
        'payroll/positions'=>'Payroll\PositionController',
        'payroll/jobs'=>'Payroll\JobController',
        'payroll/persons'=>'Payroll\PersonController'
    ]);

    Route::get('payroll/departments/get/positions/{id}','Payroll\DepartmentController@getPositions')->name('getPositions');
    Route::get('payroll/departments/get/positions/related/{id}','Payroll\DepartmentController@getPositionsRelated')->name('getPositionsRelated');
    Route::post('payroll/departments/post/positions','Payroll\DepartmentController@addPosition')->name('addPositions');


    Route::get('payroll/jobs/candidatos/{job}/','Payroll\JobController@candidatos')->name('jobs.candidatos');
    Route::get('payroll/jobs/{job}/subs','Payroll\JobController@subs')->name('jobs.subs');
    Route::get('payroll/jobs/{job}/subsIn','Payroll\JobController@subsIn')->name('jobs.subsIn');
    Route::get('payroll/jobs/{job}/subsOut','Payroll\JobController@subsOut')->name('jobs.subsOut');
    Route::post('payroll/jobs/{job}/subs/add','Payroll\JobController@subsInStore')->name('jobs.subsInStore');
    Route::post('payroll/jobs/{job}/subs/delete','Payroll\JobController@subsOutStore')->name('jobs.subsOutStore');


    Route::get('payroll/jobs/{job}/employees/','Payroll\JobController@employees')->name('jobs.employees.list');
    Route::get('payroll/jobs/{job}/chief/','Payroll\JobController@chiefEmployee')->name('jobs.chief.list');

    Route::get('payroll/departments/get/jobs/{id}','Payroll\DepartmentController@getJobs')->name('jobsSummary');
    Route::get('payroll/employee/only/edit/{id}','Payroll\EmployeeController@getOnlyEmployee')->name('employeeOnly');
    Route::post('payroll/employee/updatemployee/{employee}','Payroll\EmployeeController@updateEmployee')->name('employee.update');
    Route::post('payroll/employee/updateperson/{employee}','Payroll\EmployeeController@updatePerson')->name('person.update');

    Route::get('payroll/employee/low/{employee}','Payroll\EmployeeController@showLow')->name('employe.baja.show');
    Route::post('payroll/employee/low/{employee}','Payroll\EmployeeController@storeLow')->name('employe.baja.store');
    Route::post('payroll/jobs/assignment/store','Payroll\JobController@storeAssignment')->name('job.assignment.store');


    Route::get('payroll/jobs/get/department/areas','Payroll\JobController@getAreas')->name('postions.area');



    Route::get('payroll/jobs/areas/positions/{dep?}/{area?}','Payroll\JobController@getPositios')->name('areas.get.positions');
    Route::get('payroll/jobs/positions/get/real/','Payroll\JobController@getPositions')->name('jobs.get.positions');
    Route::get('payroll/jobs/{position}/crear/','Payroll\JobController@crear')->name('jobs.get.crear');



    Route::prefix('payroll/departemet/{department}/areaope')->name('areaope.')->group(function (){
        Route::get('list','Payroll\AreaOpeController@list')->name('list');
        Route::get('create','Payroll\AreaOpeController@create')->name('create');
        Route::post('store','Payroll\AreaOpeController@store')->name('store');
        Route::get('edit','Payroll\AreaOpeController@edit')->name('edit');
        Route::put('update','Payroll\AreaOpeController@update')->name('update');
        Route::get('positions','Payroll\AreaOpeController@positions')->name('position');
        Route::put('update','Payroll\AreaOpeController@update')->name('update');
        Route::get('related','Payroll\AreaOpeController@alterPositions')->name('alter');
    });


    Route::get('payroll/departemet/areas/{area}/add/{position}/','Payroll\AreaOpeController@addPosition')->name('areaope.addposition');
    Route::get('payroll/departemet/areas/{area}/trash/{position}/','Payroll\AreaOpeController@trashPosition')->name('areaope.trash');

});




