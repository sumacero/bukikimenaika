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
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{

    public function view_gachi(){
        $user = Auth::user();
        $param = ['user' => $user];
        return view('view_gachi', $param);
    }
    public function about(){
        return view('about');
    }
}
