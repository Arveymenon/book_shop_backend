<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    //
    public function view(){
        $inject['title'] = 'Coupons';

        return view('pages.coupons',$inject);
    }

    public function datatables(){
        $coupons = Coupon::all();

        try {
            return datatables()->of($coupons)
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

        $coupon = new Coupon;
        $coupon->name = $request['name'];
        $coupon->code = $request['code'];
        $coupon->description = $request['description'];
        $coupon->uses = $request['uses'];
        $coupon->max_uses = $request['max_uses'];
        $coupon->max_user_uses = $request['max_user_uses'];
        $coupon->minimum_cart_total = $request['minimum_cart_total'];
        $coupon->minimum_cart_total_type = $request['minimum_cart_total_type'];
        $coupon->minimum_cart_total_type_value = $request['minimum_cart_total_type_value'];
        $coupon->discount_amount = $request['discount_amount'];
        $coupon->discount_type = $request['discount_type'];
        $coupon->start_at = $request['start_at'];
        $coupon->expire_at = $request['expire_at'];
        $coupon->save();

        return redirect()->back();

    }
}
