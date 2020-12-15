<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {
        return view('home');
    }

    public function emailReset()
    {
        return view('email_reset');
    }

    public function emailChanged()
    {
        return view('email_changed');
    }

    protected function loggedOut(Request $request)
    {
        return redirect(route('home'));
    }
}

