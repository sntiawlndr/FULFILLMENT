<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

use App\Seller;

class LoginselController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('home');
        }else{
            return view('login_seller');
        }
    }

    public function actionlogin(Request $request)
    {
        $data = [
            'seller_email' => $request->input('seller_email'),
            'seller_password' => $request->input('seller_password'),
        ];

        if (Auth::guard('seller')->attempt(['seller_email' => $request->seller_email, 'seller_password' => $request->seller_password])) {
            return redirect('home');
        }else{
            Session::flash('error', 'Email atau Password Salah');
            return redirect('/');
        }
    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect('/');
    }

}
