<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InsertInputDataRequest;
use App\Http\Requests\DeleteInputDataRequest;
use App\Http\Requests\UpdateInputDataRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Rule;
use App\Stage;
use App\Buki;
use App\User;
use App\Udemae;
use App\Input_data;

class AjaxController extends Controller
{
    public function getParentTables(Request $request){
        $rules = Rule::get();
        $stages = Stage::get();
        $bukis = Buki::get();
        $udemaes = Udemae::get();
        return ['db_data' => compact('rules','stages','bukis','udemaes')];
    }
    public function getInputDatas(Request $request){
        $loginUserId = Auth::user()->id;
        $rulesCheckbox = request('rules_checkbox');
        $stagesCheckbox = request('stages_checkbox');
        $bukisCheckbox = request('bukis_checkbox');
        //絞り込み実行前(初期画面)
        if($rulesCheckbox=="" && $stagesCheckbox=="" && $bukisCheckbox=="" ){
            $input_datas = Input_data::with('user','rule','stage1','stage2','buki','udemae')->where('user_id',$loginUserId)->paginate(10);
        //絞り込み実行時
        }else{
            $input_datas = Input_data::with('user','rule','stage1','stage2','buki', 'udemae')
            ->where('user_id',$loginUserId)
            ->whereIn('rule_id', $rulesCheckbox)->whereIn('buki_id', $bukisCheckbox)
            ->whereIn('stage1_id', $stagesCheckbox);
            $input_datas = Input_data::with('user','rule','stage1','stage2','buki', 'udemae')
            ->whereIn('rule_id', $rulesCheckbox)->whereIn('buki_id', $bukisCheckbox)
            ->whereIn('stage2_id', $stagesCheckbox)->union($input_datas)->paginate(10);
        }
        //$input_datas = Input_data::with('user','rule','stage1','stage2','buki')->whereIn('rule_id', [1,2,3])->paginate(3);
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
        $loginUserId = Auth::user()->id;
        $input_data = new input_data;
        $input_data->user_id = $loginUserId;
        $input_data->rule_id = request('rule_id');
        $input_data->stage1_id = request('stage1_id');
        $input_data->stage2_id = request('stage2_id');
        $input_data->buki_id = request('buki_id');
        $input_data->udemae_id = request('udemae_id');
        //ウデマエXの場合
        if($input_data->udemae_id==21){
            //ユーザー入力のxpを設定
            $input_data->xp = request('xp');
        }else{
            //udemaesテーブルのxpを設定
            $udemaes_xp = Udemae::find($input_data->udemae_id)->xp;
            $input_data->xp = $udemaes_xp;
        }
        $input_data->save();
        $inserted_id = $input_data->input_data_id;
        $input_data = Input_data::with('user','rule','stage1','stage2','buki','udemae')->get()->find($inserted_id);
        return ['input_data' => $input_data];
    }
    public function deleteRecord(DeleteInputDataRequest $request){
        $input_datas = Input_data::find(request('input_data_id'))->delete();
        return ['input_data_id' => request('input_data_id')];
    }
    public function updateRecord(UpdateInputDataRequest $request){
        $loginUserId = Auth::user()->id;
        $input_data= Input_data::find(request('input_data_id'));
        $input_data->user_id = $loginUserId;
        $input_data->rule_id = request('rule_id');
        $input_data->stage1_id = request('stage1_id');
        $input_data->stage2_id = request('stage2_id');
        $input_data->buki_id = request('buki_id');
        $input_data->udemae_id = request('udemae_id');
        //ウデマエXの場合
        if($input_data->udemae_id==21){
            //ユーザー入力のxpを設定
            $input_data->xp = request('xp');
        }else{
            //udemaesテーブルのxpを設定
            $udemaes_xp = Udemae::find($input_data->udemae_id)->xp;
            $input_data->xp = $udemaes_xp;
        }
        $input_data->save();
        $input_data = Input_data::with('user','rule','stage1','stage2','buki','udemae')->get()->find(request('input_data_id'));
        return ['input_data' => $input_data];
    }
}
