<?php

namespace App\Http\Controllers;

use App\Inventory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    //
    public function inventoryDatatables(){
        $inventory = Inventory::with('retailers_book.book')
                        ->where('retailers_book.user_id',Auth::id());

        return $inventory;
        try {
            // return Datatables::of($rms);
            // dd(datatables()->of($inventory));
            return datatables()->of($inventory)
                ->addColumn('book', function ($inv){
                    return $inv->retailers_book->book->name;
                })
                ->rawColumns(['book'])
                ->make(true);

        }

        catch(Exception $e){

            return Response::json([
                'error' => true,
                'response' => $e
            ], 444);

        }
    }

    public function update(Request $request){
        $last_inventory = Inventory::where('retailer_book_id')->get()->last();

        if($last_inventory){
            $count = $request['input_type'] == 1 ? $last_inventory->balance_count + $request['count'] : $last_inventory->balance_count - $request['count'];
        }else{
            $count = $request['input_type'] == 1 ? $last_inventory->balance_count + $request['count'] : $last_inventory->balance_count - $request['count'];
        }

        if($count < 0){
            // Show Errors
            return redirect()->back();
        }else{
            $inventory = new Inventory;
            $inventory->input_type = $request['input_type'];
            $inventory->retailer_book_id = $request['book_id'];
            $inventory->count = $request['count'];
            $inventory->balance_count = $count;
            $inventory->save();

            return redirect()->back();
        }

    }
}
