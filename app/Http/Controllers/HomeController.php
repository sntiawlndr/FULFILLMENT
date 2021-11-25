<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
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
        return view('dashboard_seller');
    }
   

    public function adminHome()
    {
        return view('dashboard_admin');
    }
    public function logout(){
        Auth::logout();
        return redirect('/login'); // ini untuk redirect setelah logout
    }
    
}
