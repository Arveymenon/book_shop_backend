<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class SmsController extends Controller
{

    private $SMS_SENDER = "TEST";
    private $RESPONSE_TYPE = 'json';
    private $SMS_USERNAME = 'arveymenon';
    private $SMS_PASSWORD = 'arvey2509';


    public function getUserNumber(Request $request)
    {
        $phone_number = $request->input('phone_number');

        $message = $request->input('message');

        return ($this->initiateSmsActivation($phone_number, $message));
        // return ($this->initiateSmsGuzzle($phone_number, $message));

        // return redirect()->back()->with('message', 'Message has been sent successfully');
        // return \Response::json([
        //     'Working'
        // ]);
    }


    public function initiateSmsActivation($phone_number, $message){
        $url="https://www.sms4india.com/api/v1/sendCampaign";
        $message = urlencode($message); // urlencode your message
        $curl = curl_init();
        // return $phone_number;'<br>';
        curl_setopt($curl, CURLOPT_POST, 1);// set post data to true
        curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=UG2IKXE13S9A43G1FIVAS53WW06LMRLN&secret=OOZ0TDQ83CCDZIK3&usetype=stage&phone=".$phone_number."&senderid=".$this->SMS_SENDER."&message=[$message]");// post data
        // query parameter values must be given without squarebrackets.
         // Optional Authentication:
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);
        echo $result;

        '<br>';

        // if($result){
            // return array('error' => 1 );
        // }else{
            // return array('error' => 0 , 'message' => 'error');
        // }
    }

    public function initiateSmsGuzzle($phone_number, $message){
        $client = new Client();

        $response = $client->post('http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp?username=username&password
        =password&sendername=sender_id&mobileno=919999999999&message=Hello');


        $response = json_decode($response->getBody(), true);
        dd($response);
        return $response;
    }
}
