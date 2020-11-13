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
    /*
    public function login(){
        return view('login');
    }
    */
    public function create_account(){
        return view('create_account');
    }
    
    public function home(){
        return view('home');
    }
    
    public function edit_data(){
        return view('edit_data');
    }
    
    public function view_gachi(){
        return view('view_gachi');
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
