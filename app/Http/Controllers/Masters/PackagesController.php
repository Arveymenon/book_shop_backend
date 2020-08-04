<?php

namespace App\Http\Controllers\Masters;

use App\Board;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Language;
use App\Package;
use App\ProductTag;

class PackagesController extends Controller
{
    //
    public function view(){

        $inject['title'] = 'Packages Master';

        $inject['boards'] = Board::all();
        $inject['languages'] = Language::all();

        return view('pages.packages',$inject);
    }

    public function datatable(){
        $packages = Package::with('board','language');

        try {
            return datatables()->of($packages)
            ->make(true);

        }
        catch(Exception $e){

            return \Response::json([
                'error' => true,
                'response' => $e
            ], 444);

        }
    }

    public function update(Request $request){

        $package = Package::firstOrNew(['id'=> $request['package_id']]);
        $package->name = $request['name'];
        $package->image = $request->file('cover_image')->getClientOriginalName();
        $package->mrp_in_rupees = $request['mrp_in_rupees'];
        $package->board_id = $request['board_id'];
        $package->language_id = $request['language_id'];
        $package->active = $request['active'] == 'on' ? 1 : 0;
        $package->save();

        if($request['tags'] && (count($request['tags']) > 0) ){
            foreach($request['tags'] as $tag){
                $book_tag = new ProductTag();
                $book_tag->product_id = $package->id;
                $book_tag->product_type = 3;
                $book_tag->tag = $tag;
                $book_tag->save();
            }
        }

        return redirect()->back();
    }
}
