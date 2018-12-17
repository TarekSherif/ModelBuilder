<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
//=========================================================================
//========================================================================
// ActionListOfusersController-urls  
//========================================================================
Route::post('ListOfusers', 'API\ActionusersController@ListOfusers');
Route::post('Createuser', 'API\ActionusersController@Createuser');
Route::post('Updateuser', 'API\ActionusersController@Updateuser');
Route::post('Deleteuser', 'API\ActionusersController@Deleteuser');
//=========================================================================


       
//========================================================================
// ActionRoleController-urls  
//========================================================================
Route::post('ListOfRoles', 'API\ActionRoleController@ListOfRoles');
Route::post('CreateRole', 'API\ActionRoleController@CreateRole');
Route::post('UpdateRole', 'API\ActionRoleController@UpdateRole');
Route::post('DeleteRole', 'API\ActionRoleController@DeleteRole');
//=========================================================================
Route::post('RoleListoptions', 'API\ActionRoleController@RoleListoptions');

//========================================================================

//========================================================================
// ActionViewNameController-urls  
//========================================================================
 

Route::post('ListOfViewNames', 'API\ActionViewNameController@ListOfViewNames');
Route::post('CreateViewName', 'API\ActionViewNameController@CreateViewName');
Route::post('UpdateViewName', 'API\ActionViewNameController@UpdateViewName');
Route::post('DeleteViewName', 'API\ActionViewNameController@DeleteViewName');
//=========================================================================
Route::post('ViewNameListoptions', 'API\ActionViewNameController@ViewNameListoptions');
       



//========================================================================
// ActionViewRolePermissionController-urls  
//========================================================================
Route::post('ListOfViewRolePermissions/{RID}', 'API\ActionViewRolePermissionController@ListOfViewRolePermissions');
Route::post('CreateViewRolePermission', 'API\ActionViewRolePermissionController@CreateViewRolePermission');
Route::post('UpdateViewRolePermission', 'API\ActionViewRolePermissionController@UpdateViewRolePermission');
Route::post('DeleteViewRolePermission', 'API\ActionViewRolePermissionController@DeleteViewRolePermission');
//=========================================================================
Route::post('ViewRolePermissionListoptions', 'API\ActionViewRolePermissionController@ViewRolePermissionListoptions');




//========================================================================
// ActionLayerController-urls  
//========================================================================
Route::post('ListOfLayers', 'API\ActionLayerController@ListOfLayers');
Route::post('CreateLayer', 'API\ActionLayerController@CreateLayer');
Route::post('UpdateLayer', 'API\ActionLayerController@UpdateLayer');
Route::post('DeleteLayer', 'API\ActionLayerController@DeleteLayer');
//=========================================================================
Route::post('LayerListoptions', 'API\ActionLayerController@LayerListoptions');




//========================================================================
// ActionKFunctionController-urls  
//========================================================================
Route::post('ListOfKFunctions', 'API\ActionKFunctionController@ListOfKFunctions');
Route::post('CreateKFunction', 'API\ActionKFunctionController@CreateKFunction');
Route::post('UpdateKFunction', 'API\ActionKFunctionController@UpdateKFunction');
Route::post('DeleteKFunction', 'API\ActionKFunctionController@DeleteKFunction');
Route::get('ListOfACLayerType', 'API\ActionKFunctionController@ListOfACLayerType');
Route::get('ListOfACType/{Type}', 'API\ActionKFunctionController@ListOfACType');
Route::get('ListOfACModel', 'API\ActionKFunctionController@ListOfACModel');

Route::get('GetLayerParameters/{LayerID}/{LType}', 'API\ActionKFunctionController@GetLayerParameters');
Route::get('AutoSave/{LayerID}/{PName}/{PValue}', 'API\ActionKFunctionController@AutoSave');

Route::get('GenerateScript/{ModelID}', 'API\ScriptGeneratorController@GenerateScript');
 


Route::get('UpdateSOrderUp/{Tname}/{PKName}/{FKName}/{PKValue}/{FKValue}/{SOrder}', 'Controller@UpdateSOrderUp');
Route::get('UpdateSOrderDown/{Tname}/{PKName}/{FKName}/{PKValue}/{FKValue}/{SOrder}', 'Controller@UpdateSOrderDown');