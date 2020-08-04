<?php

namespace App\Http\Controllers;

use App\Book;
use App\RetailersBook;
use App\RetailersDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // $retailer = RetailersDetail::where('user_id',Auth::id())->first();


        if(RetailersDetail::where('user_id',Auth::id())->first()){

            $inject['title'] = "Dashboard";

            $inject['books'] = RetailersBook::where('user_id',Auth::id())->with('book')->get();

            return view('home',$inject);

        }else{
            $inject['title'] = "Retailer Onboarding";
            return view('pages.retailer_onboarding',$inject);

        }
    }
}
