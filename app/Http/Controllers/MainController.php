<?php

namespace App\Http\Controllers;
use App\Rule;
use App\Stage;
use App\Buki;
use App\User;
use App\Input_data;
use Illuminate\Http\Request;

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
    public function input_data(){
        $rules = Rule::all();
        $stages = Stage::all();
        $bukis = Buki::all();
        return view('input_data',['rules'=>$rules,'stages'=>$stages,'bukis'=>$bukis]);
    }
    public function input_data_complete(Request $request){
        $input_data = new input_data;
        $input_data->user_id = 1;
        $input_data->rule_id = $request->rule_id;
        $input_data->stage1_id = $request->stage1_id;
        $input_data->stage2_id = $request->stage2_id;
        $input_data->buki_id = $request->buki_id;
        $input_data->xp = $request->xp;
        $input_data->save();
        return redirect('/home');
    }
    public function view_data(){
        $items = Input_data::all();
        return view('view_data', ['items'=>$items]);
    }
    public function search_buki(){
        return view('search_buki');
    }
}
