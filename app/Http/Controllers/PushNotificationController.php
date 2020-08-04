<?php

namespace App\Http\Controllers;

use App\Customer;
use App\PushNotification;
use Illuminate\Http\Request;

class PushNotificationController extends Controller
{
    //

    public function view(){
        $inject['title'] = 'Push Notification';

        $inject['users'] = Customer::all();

        return view('pages.push-notifications',$inject);
    }

    public function datatable(){
        $notifications = PushNotification::with('customer');

        try {
            return datatables()->of($notifications)
            ->addColumn('user', function ($notification){
                return $notification->customer->name.'-'.$notification->customer->mobile;
            })
            ->make(true);
        }
        catch(Exception $e){

            return \Response::json([
                'error' => true,
                'response' => $e
            ], 444);

        }
    }

    public function send(Request $request){
        $apicontroller = new APIController;

        if($request['user'] == 0){
            $users = Customer::all();
            foreach($users as $user){
                if($user->player_id){
                    $apicontroller->callOneSignalAPI($user->player_id, $request['title'], $request['message'],$request['link']);
                }
            }

        }else{
            $player_id = Customer::select('player_id')->find($request['user'])->first()->player_id;
            $apicontroller->callOneSignalAPI($player_id, $request['title'], $request['message'],$request['link']);
        }

        return redirect()->back();
    }
}
