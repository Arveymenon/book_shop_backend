<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    //

    public function view(){

        $inject['title'] = 'All Orders';

        return view('pages.orders',$inject);
    }

    public function datatable(){
        $orders = Order::with('details.book.board','details.package.board','details.book.language','customer','address');
        // dd($orders);
        try {
            return datatables()->of($orders)
            ->addColumn('detail_section', function ($order){
                    $detail_section = '';
                    foreach($order->details as $key => $detail){
                        if($detail->product_type == 1){
                            $detail_section = $detail_section.'<br><br>'.($key+1).') Name: '.$detail->book->name.'<br> - Standard/Year: '.$detail->book->standard.'<br> - Board: '.$detail->book->board->name.'<br> - Quantity: '.$detail->quantity;
                        }else{
                            $detail_section = $detail_section.'<br><br>'.($key+1).') Name: '.$detail->package->name.'<br> - Board: '.$detail->package->board->name.'<br> - Quantity: '.$detail->quantity;
                        }
                    }
                    return $detail_section;
                })
            ->editColumn('status',function ($order){
                return '<div class="c-select u-mb-xsmall">
                 <select class="c-select__input" id="orderStatus" type="text" onchange="updateStatus('.$order->id.',this.value)" placeholder="Select">
                 <option value="0" '. ($order->status == 0 ? 'selected' : '') . ' onchange="updateStatus('.$order->id.',0)">Order Placed</option>
                 <option value="1" '.($order->status == 1 ? 'selected' : '') .' onclick="updateStatus('.$order->id.',1)">Order Active</option>
                 <option value="2" '.($order->status == 2 ? 'selected' : '') . ' onclick="updateStatus('.$order->id.',2)">Completed</option>
                 <option value="3" '.($order->status == 3 ? 'selected' : '') .' onclick="updateStatus('.$order->id.',3)">User Interruption</option>
                 <option value="4" '.($order->status == 4 ? 'selected' : '') .' onclick="updateStatus('.$order->id.',4)">Admin Interruption</option>
                 <option value="5" '.($order->status == 5 ? 'selected' : '').' onclick="updateStatus('.$order->id.',5)">Cancelled</option>
                 </select> </div>';
            })
            ->rawColumns(['detail_section','status'])
            ->make(true);

        }
        catch(Exception $e){

            return \Response::json([
                'error' => true,
                'response' => $e
            ], 444);

        }
    }

    public function updateStatus(Request $request){
        $order = Order::where('id',$request['order_id'])->first();
        $order->status = $request['status'];
        $order->update();

        return \Response::json([
            'error' => false,
            'response' => $order
        ]);
    }
}
