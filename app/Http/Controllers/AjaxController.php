<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InsertInputDataRequest;
use App\Http\Requests\DeleteInputDataRequest;
use App\Http\Requests\UpdateInputDataRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Rule;
use App\Stage;
use App\Buki;
use App\User;
use App\Gachi;
use App\Udemae;
use App\Input_data;

class AjaxController extends Controller
{
    public function getParentTables(Request $request){
        $loginUserId = Auth::user()->id;
        $rules = Rule::get();
        $stages = Stage::get();
        $bukis = Buki::get();
        //$input_datas = Input_data::with('user','gachi.rule','gachi.stage1','gachi.stage2','buki','udemae')->where('user_id',$loginUserId);
        $input_datas = Input_data::with('user','gachi.rule','gachi.stage1','gachi.stage2','buki','udemae')->where('user_id',$loginUserId)->get();
        $udemaes = Udemae::get();
        return ['db_data' => compact('rules','stages','bukis','input_datas','udemaes')];
    }

    public function getGachis(Request $request){
        $initFlag = request('init_flag');
        //初回アクセス時
        if($initFlag == "true"){
            $gachis = Gachi::with('rule','stage1','stage2')->paginate(10);
        //絞り込み実行時
        }else{
            $dateCheckbox = request('date_checkbox');
            if($dateCheckbox==null){
                $dateCheckbox = array();
            }
            $rulesCheckbox = request('rules_checkbox');
            if($rulesCheckbox==null){
                $rulesCheckbox = array();
            }
            $stagesCheckbox = request('stages_checkbox');
            if($stagesCheckbox==null){
                $stagesCheckbox = array();
            }
            $bukisCheckbox = request('bukis_checkbox');
            if($bukisCheckbox==null){
                $bukisCheckbox = array();
            }
            $inputDataRadio = request('input_data_radio');
            $udemaesPull = request('udemaes_pull');
            $xpText = request('xp_text');
            $udemaeRelationRadio = request('udemae_relation_radio');
            $loginUserId = Auth::user()->id;
            //ルール、ステージフィルタ
            $gachis = Gachi::with('rule','stage1','stage2')
            ->where(function($gachis) use($rulesCheckbox){
                $gachis->whereIn('rule_id', $rulesCheckbox);
            })->where(function($gachis) use($stagesCheckbox) {
                $gachis->orwhereIn('stage1_id',$stagesCheckbox)
                      ->orWhereIn('stage2_id',$stagesCheckbox);
            });

            //オブジェクトのコピー
            $futureGachis = clone $gachis;
            $currentGachis = clone $gachis;
            $pastGachis = clone $gachis;
            //日付フィルタ
            $nowTimeStamp = Carbon::now();
                $gachisGachiIds=array();
                if(count($dateCheckbox)>=1){
                    foreach($dateCheckbox As $state){
                        switch($state){
                            case "future":
                                $futureGachis = $futureGachis->where('start_t', '>', $nowTimeStamp)->pluck('gachi_id');
                                foreach($futureGachis As $gachiId){
                                    $gachisGachiIds[] = $gachiId;
                                }
                            break;

                            case "current":
                                $currentGachis = $currentGachis->where('start_t', '<=', $nowTimeStamp)->where('end_t', '>=', $nowTimeStamp)->pluck('gachi_id');
                                foreach($currentGachis As $gachiId){
                                    $gachisGachiIds[] = $gachiId;
                                }
                            break;
                            case "past":
                                $pastGachis = $pastGachis->where('end_t', '<', $nowTimeStamp)->pluck('gachi_id');
                                foreach($pastGachis As $gachiId){
                                    $gachisGachiIds[] = $gachiId;
                                }
                            break;       
                        }
                    }
                }
                $gachis = $gachis->whereIn('gachi_id', $gachisGachiIds);

            //戦績有無フィルタ
            $inputDatas = Input_data::where('user_id',$loginUserId)->get();
            $inputDataGachiIds=array();
            foreach($inputDatas As $inputData){
                array_push($inputDataGachiIds, $inputData->gachi_id);
            }
            switch($inputDataRadio){
                //戦績有りまたは無し
                case 'all':
                break;
                //戦績有りのみ
                case 'inserted':
                    //ブキフィルタ
                    $inputDataGachiIds=array();
                    if(count($bukisCheckbox)>=1){
                        foreach($inputDatas As $inputData){
                            if(in_array($inputData->buki_id, $bukisCheckbox)){
                                array_push($inputDataGachiIds, $inputData->gachi_id);
                            }
                        }
                    }
                    $gachis = $gachis->whereIn('gachi_id', $inputDataGachiIds);
                    //ウデマエフィルタ
                    $inputDataGachiIds=array();
                    if($udemaesPull != null){
                        switch($udemaeRelationRadio){
                            case '>=':
                                //ウデマエXかつXP指定ありの場合XPでフィルタ
                                if($udemaesPull=='21' && is_numeric($xpText)){
                                    foreach($inputDatas As $inputData){
                                        if($inputData->xp >= $xpText){
                                            array_push($inputDataGachiIds, $inputData->gachi_id);
                                        }
                                    }
                                //ウデマエでフィルタ
                                }else{
                                    foreach($inputDatas As $inputData){
                                        if($inputData->udemae_id >= $udemaesPull){
                                            array_push($inputDataGachiIds, $inputData->gachi_id);
                                        }
                                    }
                                }
                            break;
                            case '<=':
                                //ウデマエXかつXP指定ありの場合XPでフィルタ
                                if($udemaesPull=='21' && is_numeric($xpText)){
                                    foreach($inputDatas As $inputData){
                                        if($inputData->xp <= $xpText){
                                            array_push($inputDataGachiIds, $inputData->gachi_id);
                                        }
                                    }
                                //ウデマエでフィルタ
                                }else{
                                    foreach($inputDatas As $inputData){
                                        if($inputData->udemae_id <= $udemaesPull){
                                            array_push($inputDataGachiIds, $inputData->gachi_id);
                                        }
                                    }
                                }
                            break;
                        }
                        $gachis = $gachis->whereIn('gachi_id', $inputDataGachiIds);
                    }
                break;
                //戦績無しのみ
                case 'uninserted':
                    $gachis = $gachis->whereNotIn('gachi_id', $inputDataGachiIds);
                break;          
            }
            $gachis = $gachis->paginate(10);
        }
        return ['db_data' => $gachis];
    }
    public function insertRecord(InsertInputDataRequest $request){
        $loginUserId = Auth::user()->id;
        $input_data = new input_data;
        $input_data->user_id = $loginUserId;
        $input_data->gachi_id = request('gachi_id');
        $input_data->buki_id = request('buki_id');
        $input_data->udemae_id = request('udemae_id');
        $input_data->win = request('win');
        $input_data->lose = request('lose');
        $input_data->comment = request('comment');
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
        $input_data = Input_data::with('user','gachi.rule','gachi.stage1','gachi.stage2','buki','udemae')->get()->find($inserted_id);
        return ['input_data' => $input_data];
    }
    public function deleteRecord(DeleteInputDataRequest $request){
        $input_datas = Input_data::find(request('input_data_id'))->delete();
        return ['input_data_id' => request('input_data_id')];
    }
    public function updateRecord(UpdateInputDataRequest $request){
        $input_data= Input_data::find(request('input_data_id'));
        $input_data->buki_id = request('buki_id');
        $input_data->udemae_id = request('udemae_id');
        $input_data->win = request('win');
        $input_data->lose = request('lose');
        $input_data->comment = request('comment');
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
        $input_data = Input_data::with('user','gachi.rule','gachi.stage1','gachi.stage2','buki','udemae')->get()->find(request('input_data_id'));
        return ['input_data' => $input_data];
    }
    public function getOsusumeBukis(){
        $loginUserId = Auth::user()->id;
        $gachis = Gachi::with('rule','stage1','stage2');
        $nowTimeStamp = Carbon::now();
        $currentGachi = $gachis->where('start_t', '<=', $nowTimeStamp)->where('end_t', '>=', $nowTimeStamp)->first();
        $currentGachiId = null;
        $osusumeBukis = null;
        if($currentGachi!=null){
            $targetGachiId  = $currentGachi->gachi_id; 
            $ruleId = $currentGachi->rule_id;
            $stage1Id = $currentGachi->stage1_id;
            $stage2Id = $currentGachi->stage2_id;

            $targetGachiIds = Gachi::with('rule','stage1','stage2')->where(function($items) use ($loginUserId,$ruleId){
                $items->where('rule_id',$ruleId);
            })->where(function($items)use($stage1Id,$stage2Id){
                $items->orwhereIn('stage1_id',[$stage1Id,$stage2Id])
                    ->orWhereIn('stage2_id',[$stage1Id,$stage2Id]);
            })->pluck('gachi_id');
            $osusumeBukis = Input_data::leftJoin('bukis','input_datas.buki_id','=','bukis.buki_id')
            ->whereIn('gachi_id',$targetGachiIds)
            ->select('bukis.buki_id','bukis.buki_name', DB::raw('avg(input_datas.xp) as total'))
            ->groupBy('bukis.buki_id','bukis.buki_name')
            ->orderBy('total','desc')
            ->get();
        }
        return ['osusumeBukis' => compact('osusumeBukis','targetGachiId')];
        //return ['osusumeBukis' => $osusumeBukis];
    }
}
