<?php

namespace App\Http\Controllers;

use App\Book;
use App\RetailersBook;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RetailersBooksController extends Controller
{
    //

    public function view(){

        $inject['title'] = 'Retailers Books';

        $inject['books'] = Book::all();
        return view('pages.retailers_books',$inject);
    }

    public function datatable(){
        $r_book = RetailersBook::where('user_id',Auth::id())->get();

        try {
            return datatables()->of($r_book)
            ->make(true);

        }
        catch(Exception $e){

            return \Response::json([
                'error' => true,
                'response' => $e
            ], 444);

        }
    }
}
