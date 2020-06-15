<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Rule;
use App\Stage;
use App\Buki;
use App\User;
use App\Input_data;
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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::group(['middleware' => 'api'],function(){
    Route::post('/insert_data',function(){
        $input_data = new input_data;
        /*
        $input_data->user_id = 1;
        $input_data->rule_id = $request->rule_id;
        $input_data->stage1_id = $request->stage1_id;
        $input_data->stage2_id = $request->stage2_id;
        $input_data->buki_id = $request->buki_id;
        $input_data->xp = $request->xp;
        
        $input_data->save();
        */
        return ['xp' => request('xp')];
    });

});
