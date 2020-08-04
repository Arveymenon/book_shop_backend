<?php

namespace App\Http\Controllers;

use App\Board;
use App\Book;
use App\Coupon;
use App\Customer;
use App\CustomerAddress;
use App\Order;
use App\OrderDetail;
use App\Package;
use App\ProductTag;
use App\PushNotification;
use App\ResaleOrder;
use App\ResaleOrderDetails;
use App\RetailersDetail;
use GuzzleHttp\Client;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;
use SiteHelpers;

class APIController extends Controller
{
    //
    public static function callOneSignalAPI($player, $title, $message, $link){

        $client = new Client();
        $response = $client->request('POST', 'https://onesignal.com/api/v1/notifications', [
            'headers' => [
                'Accept'     => 'application/json',
                'Cache-Control' => 'no-cache',
                'Content-Type' => 'application/json'
            ],
            'json'    => [
                'include_player_ids' => [$player],
                'app_id' => '11482de5-db43-43bd-aed4-9ebf163c569d',
                'contents' => ['en' => $message],
                'headings' => ['en' => $title]
            ],
        ]);
        // dd($response);
        if($response->getStatusCode() != 200){
            // LOG RESPONSE
            dd($response);
        }else{
            $notification = new PushNotification();
            $notification->player_id = $player;
            $notification->title = $title;
            $notification->message = $message;
            $notification->link = $link;
            $notification->save();
        }
    }

    public function register(Request $request){

        $unique_rule = '';
        if($request['user_id'] && $request['user_id'] != 0){
            $unique_rule = ','.$request['user_id'];
        }

        $validator = \Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required | unique:users,email'.$unique_rule,
            'mobile' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->first());
        }else{
            // return \Response::json($request->all());
            $customer = Customer::firstOrNew(['id'=> $request['user_id']]);
            $customer->name = $request['name'];
            $customer->email = $request['email'];
            $customer->mobile = $request['mobile'];
            $customer->player_id = $request['player_id'];
            $customer->save();

            return \Response::json([
                'error' => false,
                'response' => $customer
            ]);
        }

    }

    public function login(Request $request){
        $customer = Customer::where('mobile',$request['mobile'])->first();

        if($customer){
            return \Response::json([
                'error' => false,
                'response' => $customer
            ]);
        }else{
            return \Response::json([
                'error' => true,
                'message' => 'No User With this Mobile Number'
            ]);
        }

    }

    public function getBooks(Request $request, $id){
        // return \Response::json($request->all());

        if($id == 0){
            $books = Book::where('active',1)->with('board')
                ->when($request->subject, function($q) use($request){
                    return $q->where('subject',$request->subject);
                })
                ->when($request->board, function($q) use($request){
                    return $q->where('board_id',$request->board);
                })
                ->when($request->standard, function($q) use($request){
                    return $q->where('standard',$request->standard);
                })
                ->when($request->refurbished, function($q) use($request){
                    return $q->where('refurbished_available',$request->refurbished == true ? 1 : 0);
                })
                ->get();
        }else{
            $books = Book::where('id',$id)->with('board')->first();
        }

        return \Response::json([
            'error' => false,
            'response' => $books
        ]);
    }

    public function booksFilterOptions(){
        $standards = Book::select('standard')->distinct()->pluck('standard');
        $subjects = Book::select('subject')->distinct()->pluck('subject');
        $board = Board::select('id','name')->get();

        return \Response::json([
            'error' => false,
            'response' => [
                'subjects' => $subjects,
                'standards' => $standards,
                'boards' => $board
            ]
        ]);
    }

    public function getAddresses($id){
        // $id = customer_id
        $addresses = CustomerAddress::where('customer_id',$id)->get();

        return \Response::json([
            'error' => false,
            'response' => $addresses
        ]);
    }

    public function updateAddress(Request $request){

        $address = new CustomerAddress;
        $address->customer_id = $request['customer_id'];
        $address->latitude = $request['latitude'];
        $address->longitude = $request['longitude'];
        $address->address = $request['address'];
        $address->flat = $request['flat'];
        $address->landmark = $request['landmark'];
        $address->save();

        return \Response::json([
            'error' => false,
            'response' => $address
        ]);
    }

    public function deleteAddress($id){
        CustomerAddress::where('id',$id)->first()->delete();

        return \Response::json([
            'error' => false,
            'response' => 'Address deleted successfully'
        ]);
    }

    public function postOrders(Request $request){
        $order = new Order;
        $order->customer_id = $request['customer_id'];
        $order->address_id = $request['address_id'];
        $order->transaction_id = $request['transaction_id'];
        $order->status = $request['status'];
        $order->save();

        foreach($request['details'] as $detail){
            $order_detail = new OrderDetail;
            $order_detail->order_id = $order->id;
            $order_detail->product_type = $detail['product_type'];
            $order_detail->product_id = $detail['book']['id'];
            $order_detail->refurbished = isset($detail['refurbished']) ? $detail['refurbished'] : 0;
            $order_detail->quantity = $detail['quantity_in_cart'];
            $order_detail->save();
        }

        SiteHelpers::addParticular($order->id,1,'',$request['sub_total']);
        // return $request;
        if($request['coupon']['code']){
            $coupon = Coupon::where('code',$request['coupon']['code'])->first();
            $coupon->uses = $coupon->uses + 1;
            SiteHelpers::addParticular($order->id,2,$request['coupon']['code'],($request['total'] - $request['sub_total']));
        }
        SiteHelpers::addParticular($order->id,4,'',$request['total']);

        return \Response::json([
            'error' => false,
            'response' => $order
        ]);
    }

    public function orderCancelation($id){
        $order = Order::where('id',$id)->first();
        $order->status = 3;
        $order->update();

        return \Response::json([
            'error' => false,
            'response' => $order
        ]);
    }

    public function usersOrder($id){
        $orders = Order::where('customer_id',$id)->with('details')
        ->with(['particular'=> function($query){
            return $query->where('particular_type_id',4);
        }])
        ->get();
        return \Response::json([
            'error' => false,
            'response' => $orders
        ]);
        // ->whereHas('particular',function($query){
        //     return $query->where('particular_type_id',4);
        // })

    }

    public function getOrderDetails($id){
        $orders = Order::where('id',$id)->with('details.book.board','resale_order')
        ->with(['particular'=> function($query){
            return $query->where('particular_type_id',4);
        }])->first();

        return \Response::json([
            'error' => false,
            'response' => $orders
        ]);
    }

    public function postResale(Request $request){

        $resale_order = new ResaleOrder();
        $resale_order->order_id = $request['order_id'];
        $resale_order->address_id = $request['address_id'];
        if($resale_order->status){
            $resale_order->status = $request['status'];
        }
        $resale_order->save();

        foreach($request['details'] as $detail) {
            // $product_id = ResaleOrderDetails::select('product_id')->where('id',$detail['order_details_id'])->first();

            $order_detail = new ResaleOrderDetails;
            $order_detail->resale_order_id = $resale_order->id;
            $order_detail->order_details_id = $detail['order_details_id'];
            $order_detail->quantity = $detail['quantity'];
            $order_detail->status = 0;
            $order_detail->save();
        }

        return \Response::json([
            'error' => false,
            'response' => $resale_order
        ]);
    }

    public function getUserResaleOrders($id){
        $orders = ResaleOrder::with('details.order_detail')
        ->whereHas('order.customer', function($query) use($id){
            return $query->where('customer_id',$id);
        })
        ->get();
        return \Response::json([
            'error' => false,
            'response' => $orders
        ]);
    }

    public function getResaleOrderDetails($id){
        $order_details = ResaleOrder::where('id',$id)->with('details.order_detail.book.board')->first();
        return \Response::json([
            'error' => false,
            'response' => $order_details
        ]);
    }


    public function checkCouponCode(Request $request){
        $couponCode = $request['code'];
        $response = SiteHelpers::checkCoupon($couponCode, $request['customerId'],$request['cartTotal'],$request['cart']);

        return \Response::json($response);
    }

    public function getRecommendations(Request $request){
        $recommendations = collect();

        foreach($request->all() as $cart_product){
            // dd($request->all());
            if($cart_product['product_type']){

                $cart_product_tags = ProductTag::where('product_id', $cart_product['book']['id'])->where('product_type',$cart_product['product_type'])->get();

                foreach ($cart_product_tags as $tag) {
                    $products = ProductTag::select('product_id','product_type')->where('tag',$tag->tag)->where('id','!=',$tag->id)->get();

                    foreach ($products as $product) {

                        // if the product already exists in the cart

                        $product_id_exists = array_search($product->id, array_column($request->all(), 'id'));
                        $product_type_exists = array_search($product->product_type, array_column($request->all(), 'product_type'));
                        // return [$cart_type_exists, $cart_id_exists];
                        if($product_type_exists == false && $product_id_exists == false){
                            $recommended_product = $recommendations->where('id',$product->product_id)->first();

                            if(!$recommended_product){
                                switch ($product->product_type) {
                                    case 1:
                                        $product = Book::where('id',$product->product_id)->with('board','language')->first();
                                        $product->product_type = 1;
                                    break;

                                    case 2:
                                        // $product = Product::where('id',$product->product_id)->first();
                                    break;

                                    case 3:
                                        $product = Package::where('id',$product->product_id)->with('board','language')->first();
                                        $product->product_type = 3;
                                        break;

                                    default:
                                        echo('shit');
                                        break;
                                }
                                $product->tag_match_count = 1;
                                $recommendations->push($product);
                            }else{
                                $recommended_product->tag_match_count = $recommended_product['tag_match_count'] + 1;
                            }
                        }

                    }
                }
            }
        }


        return \Response::json(
            [
                'error' => false,
                'response' => $recommendations
            ]);
    }

    // place in retailers controllers

    public function retailerDetailsUpdate(Request $request){
        // dd($request->input());

        $validator = Validator::make($request->all(), [
            'shop_name' => 'required',
            'address' => 'required',
            'path' => 'required',
            'commission' => 'required'
        ]);
        $retailer_details = RetailersDetail::firstOrNew(['user_id' => Auth::id()]);
        $retailer_details->user_id = Auth::id();
        $retailer_details->shop_name = $request['shop_name'];
        $retailer_details->address = $request['address'];
        $retailer_details->latitude = $request['latitude'];
        $retailer_details->longitude = $request['longitude'];
        $retailer_details->delivery_path = $request['path'];
        $retailer_details->delivery_commission = $request['commission'];
        $retailer_details->save();

        if($validator->fails()){
            return Redirect::back()->withErrors(['msg', $validator->errors()]);
        }else{
            return redirect('/home')->with('success','Retailers Updated Successfully');
        }
    }
}
