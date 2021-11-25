<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\FmUser;
use DB;
use Auth;

class ProfilSellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ("seller_profil.profilsel");
    }

    public function profile_detail(){
        $user_id=Auth::user()->user_id;
        $data = FmUser:: user_get_by_id($user_id);
        
        return view('seller_profil.profilsel')->with('profile',$data[0]);
    }
 
    public function destroy($id)
    {
        //
    }
}
