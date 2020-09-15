<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InsertInputDataRequest;
use App\Http\Requests\DeleteInputDataRequest;
use App\Http\Requests\UpdateInputDataRequest;
use Illuminate\Support\Facades\DB;
use App\Rule;
use App\Stage;
use App\Buki;
use App\User;
use App\Input_data;

class AjaxController extends Controller
{
    public function getParentTables(Request $request){
        $rules = Rule::get();
        $stages = Stage::get();
        $bukis = Buki::get();
        return ['db_data' => compact('rules','stages','bukis')];
    }
    public function getInputDatas(Request $request){
        $input_datas = Input_data::with('user','rule','stage1','stage2','buki')->paginate(10);
        return ['db_data' => $input_datas];
    }
    public function getStageInfo(Request $request){
        $url = "https://spla2.yuu26.com/gachi";
        $ch = crul_init($url);
        $options = array(CURLOPT_RETURNTRANSFER => 1,
                 CURLOPT_TIMEOUT => 3 //タイムアウトするまでの時間
                );
        curl_setopt_array($ch,$option);

        $json_data = curl_exec($ch);
        //$json = json_decode($json_data,true);
        //$array = json_decode($json);
        //$array = array_slice($json, -10);
        //$json = json_encode($array);
        return ['stage_info' => $json_data];
    }
    public function insertRecord(InsertInputDataRequest $request){
        $input_data = new input_data;
        $input_data->user_id = 1;
        $input_data->rule_id = request('rule_id');
        $input_data->stage1_id = request('stage1_id');
        $input_data->stage2_id = request('stage2_id');
        $input_data->buki_id = request('buki_id');
        $input_data->xp = request('xp');
        $input_data->save();
        $inserted_id = $input_data->input_data_id;
        $input_data = Input_data::with('user','rule','stage1','stage2','buki')->get()->find($inserted_id);
        return ['input_data' => $input_data];
    }
    public function deleteRecord(DeleteInputDataRequest $request){
        $input_datas = Input_data::find(request('input_data_id'))->delete();
        return ['input_data_id' => request('input_data_id')];
    }
    public function updateRecord(UpdateInputDataRequest $request){
        $input_data= Input_data::find(request('input_data_id'));
        $input_data->user_id = 1;
        $input_data->rule_id = request('rule_id');
        $input_data->stage1_id = request('stage1_id');
        $input_data->stage2_id = request('stage2_id');
        $input_data->buki_id = request('buki_id');
        $input_data->xp = request('xp');
        $input_data->save();
        $input_data = Input_data::with('user','rule','stage1','stage2','buki')->get()->find(request('input_data_id'));
        return ['input_data' => $input_data];
    }
}
