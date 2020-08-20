<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Rule;
use App\Stage;
use App\Buki;
use App\User;
use App\Input_data;
use Illuminate\Http\Request;
use Validator;

class MainController extends Controller
{
    public function login(){
        return view('login');
    }
    public function create_account(){
        return view('create_account');
    }
    public function home(){
        return view('home');
    }
    
    public function edit_data(){
        $input_datas = Input_data::with('user','rule','stage1','stage2','buki')->get();
        $rules = Rule::get();
        $stages = Stage::get();
        $bukis = Buki::get();
        return view('edit_data',compact('input_datas', 'rules','stages','bukis'));
    }
    
    public function insert_data(Request $request){
        $rules = [
            'rule_id' => 'required',
            'stage1_id' => 'required',
            'stage2_id' => 'required',
            'buki_id' => 'required',
            'xp' => 'numeric|between:1000,4000'
        ];
        $messages = [
            'rule_id.required' => 'ルールを選択してください。',
            'stage1_id.required' => 'ステージ1を選択してください。',
            'stage2_id.required' => 'ステージ2を選択してください。',
            'buki_id.required' => 'ブキを選択してください。' ,
            'xp.numeric' => '数値を入力してください。',
            'xp.between' => '1000～4000の間で入力してください。',
            'stage1_id.different' => 'ステージ1とステージ2が重複しています。',
            'stage2_id.different' => 'ステージ1とステージ2が重複しています。'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->sometimes('stage1_id','different:stage2_id',function($input){
            //ステージ1とステージ2の両方が選択されている場合、ルールを追加
            return !empty($input->stage1_id)&&!empty($input->stage2_id);
        });
        if($validator->fails()){
            return redirect('/edit_data')->withErrors($validator)->withInput();
        }
        
        $input_data = new input_data;
        $input_data->user_id = 1;
        $input_data->rule_id = $request->rule_id;
        $input_data->stage1_id = $request->stage1_id;
        $input_data->stage2_id = $request->stage2_id;
        $input_data->buki_id = $request->buki_id;
        $input_data->xp = $request->xp;
        $input_data->save();
        return redirect('/edit_data');  
    }
    

    public function update_data(Request $request){
        $rules = [
            'rule_id' => 'required',
            'stage1_id' => 'required',
            'stage2_id' => 'required',
            'buki_id' => 'required',
            'xp' => 'numeric|between:1000,4000'
        ];
        $messages = [
            'rule_id.required' => 'ルールを選択してください。',
            'stage1_id.required' => 'ステージ1を選択してください。',
            'stage2_id.required' => 'ステージ2を選択してください。',
            'buki_id.required' => 'ブキを選択してください。' ,
            'xp.numeric' => '数値を入力してください。',
            'xp.between' => '1000～4000の間で入力してください。',
            'stage1_id.different' => 'ステージ1とステージ2が重複しています。',
            'stage2_id.different' => 'ステージ1とステージ2が重複しています。'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->sometimes('stage1_id','different:stage2_id',function($input){
            //ステージ1とステージ2の両方が選択されている場合、ルールを追加
            return !empty($input->stage1_id)&&!empty($input->stage2_id);
        });
        if($validator->fails()){
            return redirect('/edit_data')->withErrors($validator)->withInput();
        }
        
        $input_data = Input_data::find($request->input_data_id);
        $input_data->user_id = 1;
        $input_data->rule_id = $request->rule_id;
        $input_data->stage1_id = $request->stage1_id;
        $input_data->stage2_id = $request->stage2_id;
        $input_data->buki_id = $request->buki_id;
        $input_data->xp = $request->xp;
        $input_data->save();
        return redirect('/edit_data');  
    }

    public function search_buki(){
        $rules = Rule::all();
        $stages = Stage::all();
        if(empty($items)){
            $items = null;
        }
        
        return view('search_buki',['rules'=>$rules,'stages'=>$stages]);
    }
    public function analysis_buki(Request $request){
        $rules = [
            'rule_id' => 'required',
            'stage1_id' => 'required',
            'stage2_id' => 'required',
        ];
        $messages = [
            'rule_id.required' => 'ルールを選択してください。',
            'stage1_id.required' => 'ステージ1を選択してください。',
            'stage2_id.required' => 'ステージ2を選択してください。',
            'stage1_id.different' => 'ステージ1とステージ2が重複しています。',
            'stage2_id.different' => 'ステージ1とステージ2が重複しています。'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->sometimes('stage1_id','different:stage2_id',function($input){
            //ステージ1とステージ2の両方が選択されている場合、ルールを追加
            return !empty($input->stage1_id)&&!empty($input->stage2_id);
        });
        if($validator->fails()){
            return redirect('/search_buki')->withErrors($validator)->withInput();
        }

        $items = Input_data::where(function($items) use ($request) {
            $items->where('user_id','1')
                  ->where('rule_id',$request->rule_id);
        })->where(function($items) use ($request) {
            $items->orwhereIn('stage1_id',[$request->stage1_id,$request->stage2_id])
                  ->orWhereIn('stage2_id',[$request->stage1_id,$request->stage2_id]);
        })->select('buki_id',DB::raw('avg(xp) as total'))
        ->groupBy('buki_id')
        ->orderBy('total','desc')
        ->get();
        return redirect('search_buki')->with(['items'=>$items])->withInput();;
    }


}
