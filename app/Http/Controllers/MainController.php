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
    public function view_data(){
        $items = Input_data::all();
        return view('view_data', ['items'=>$items]);
    }
    public function search_buki(){
        return view('search_buki');
    }
}
