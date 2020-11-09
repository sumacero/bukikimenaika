<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HelloController extends Controller
{
    public function index(Request $request){
        $user = Auth::user();
        $sort = $request->sort;
        //$items = Person::orderBy($sort, 'asc')->simplePaginate(5);
        $param = ['sort' => $sort, 'user' => $user];
        return view('hello.index', $param);
    }

    public function getAuth(Request $request){
        $param = ['message' => 'ログインしてください。'];
        return view('login', $param);
    }

    public function postAuth(Request $request){
        $email = $request->email;
        $password = $request->password;
        if(Auth::attempt(['email' => $email, 'password' => $password])){
            $msg = 'ログインしました。('.Auth::user()->name. ')';
        }else{
            $msg = 'ログインに失敗しました。';
        }
        return view('login', ['message' => $msg]);
    }
}
