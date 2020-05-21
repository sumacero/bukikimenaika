<?php

namespace App\Http\Controllers;

use App\Buki;
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
        return view('input_data');
    }
    public function view_data(){
        $items = Buki::all();
        return view('view_data', ['items'=>$items]);
    }
    public function search_buki(){
        return view('search_buki');
    }
}
