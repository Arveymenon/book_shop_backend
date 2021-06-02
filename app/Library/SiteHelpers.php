<?php

use App\Book;
use App\Coupon;
use App\Order;
use App\Particular;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

class SiteHelpers
{

    public static function checkCoupon($couponCode,$customerId,$cartTotal,$cart){
        $coupon = Coupon::where('code',$couponCode)->with('users_assigned')->first();
        $today = Carbon::now();
        $data = new stdClass();

        if($coupon){

            // If Coupon Has been assigned to people and if it's valid
            if(count($coupon->users_assigned) > 0 ){
                $user_exist = $coupon->users_assigned->first(function($user) use($customerId){ return $user->id == $customerId; });
                if(!$user_exist){
                    $data->validated = false;
                    $data->message = 'This Coupon Cannot Be Used By This Account';
                    return $data;
                }
            }

            // start date test
            $coupon_start_date = Carbon::parse($coupon->start_at);
            if($coupon->start_at != null && $today->isBefore($coupon_start_date)){
                $data->validated = false;
                $data->message = 'Coupon Will Be Active After'.$coupon_start_date->format('Y-m-d');
                return $data;
            }

            // Expiry Check
            $coupon_expiry_date = Carbon::parse($coupon->expire_at);
            if($coupon->expiry_at != null && $today->isAfter($coupon_expiry_date)){
                $data->validated = false;
                $data->message = 'Coupon Expired On'.$coupon_expiry_date->format('Y-m-d');
                return $data;
            }

            if($coupon->uses >= $coupon->max_uses){
                $data->validated = false;
                $data->message = 'Coupon Not Valid Anymore';
                return $data;
            }

            // Max User per User

            $customer_uses = Order::where('customer_id',$customerId)
                ->whereHas('particular', function($query) use($couponCode){
                    return $query->where('description',$couponCode);
                })
                ->where('status','!=',5)
                ->get();

            if(count($customer_uses) >= $coupon->max_user_uses){
                $data->validated = false;
                $data->message = 'User Has Used This Coupon Maximum Number Of Time Available';
                return $data;
            }

            if($cartTotal < $coupon->minimum_cart_total){
                $data->validated = false;
                $data->message = 'Minimum Total Needs To be '.$coupon->minimum_cart_total;
                return $data;
            }

            if($coupon->minimum_cart_total_type && ($coupon->minimum_cart_total_type != 0)){
                $product_type_total = 0; // in cart
                $other_product_type_total = 0; // in cart

                foreach($cart as $cart_item){
                    if($cart_item['product_type'] == $coupon->minimum_cart_total_type){
                        $product = Book::where('id',$cart_item['product_id'])->first();

                        $product_type_total = $product_type_total + (($cart_item['refurbished'] == true ? round($product->mrp_in_rupees * 0.8) : $product->mrp_in_rupees) * $cart_item['quantity_in_cart']);
                    }else{
                        $product = Book::where('id',$cart_item['product_id'])->first();

                        $other_product_type_total = $other_product_type_total + (($cart_item['refurbished'] == true ? round($product->mrp_in_rupees * 0.8) : $product->mrp_in_rupees) * $cart_item['quantity_in_cart']);
                    }

                }

                if($product_type_total < $coupon->minimum_cart_total_type_value){
                    $data->validated = false;
                    $type = $coupon->minimum_cart_total_type == 1 ? 'Books': 'Products';
                    $data->message = 'Minimum Cart Total of '.$type.' Needs To Be '.$coupon->minimum_cart_total_type_value.' To Use This Coupon';

                    return $data;
                }

                if($coupon->discount_type == 1){
                    $discounted_total = (float)($product_type_total - $coupon->discount_amount) + $other_product_type_total;
                } elseif($coupon->discount_type == 2){
                    $discounted_total = (float)($product_type_total * $coupon->discount_amount/100) + $other_product_type_total;
                }

                $data->validated = true;

                $data->discount_amount = $coupon->discount_amount;
                $data->discount_type = $coupon->discount_type;

                $data->discounted_product_type_total = $product_type_total;
                $data->discounted_other_product_type_total = $other_product_type_total;

                $data->discounted_total = $discounted_total;

                return $data;
            }

            if($coupon->discount_type == 1){
                $discounted_total = ($cartTotal - $coupon->discount_amount);
            } elseif($coupon->discount_type == 2){
                $discounted_total = ($cartTotal * $coupon->discount_amount/100);
            }

            $data->validated = true;
            $data->discount_amount = $coupon->discount_amount; // Amount to be deducted
            $data->discount_type = $coupon->discount_type; // Whether a percent or amount to be deducted
            $data->discounted_total = $discounted_total; // Final Cart Value to be

            return $data;


        }else{
            $data->validated = false;
            $data->message = 'Invalid Coupon Code';

            return $data;
        }
    }

    public static function addParticular($order_id, $particular_type_id, $description, $amount){
        $particular = new Particular;
        $particular->order_id = $order_id;
        $particular->particular_type_id = $particular_type_id;
        $particular->description = $description;
        $particular->amount = $amount;
        $particular->save();

        return $particular;
    }

    public static function compressFile($file,$compress_rate){
        $img = Image::make($file->getRealPath());
        $compressed_image = $img->resize($compress_rate, $compress_rate, function ($constraint) {
            $constraint->aspectRatio();
        });
        $filename =  str_replace(' ', '_', $file->getClientOriginalName());
        return [
            'file'=> $compressed_image,
            'file_name'=> $filename
        ];
    }

}
?>
