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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('main');
    }
    public function messanger()
    {
        return view('messanger');
    }
    public function profile(){
        return view('pages.profile');
    }
    public function users(){
        return view('pages.users');
    }
    public function news(){
        return view('news');
    }
}
