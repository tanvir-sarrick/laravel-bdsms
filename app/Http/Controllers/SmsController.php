<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Xenon\LaravelBDSms\Sender;
use Xenon\LaravelBDSms\Facades\SMS;
use Xenon\LaravelBDSms\Provider\Ssl;

class SmsController extends Controller
{
    public function Ssl()
    {
        // Simply use the facade start
        //echo SMS::shoot('01723897676', 'helloooooooo boss!');

        // Simply use the facade end

        try {
            // Initialize the Sender instance
            $sender = Sender::getInstance();
            // Set the provider
            $sender->setProvider(Ssl::class);


            // Set the mobile number (can be an array of numbers)
            $sender->setMobile('01723895757');

            // $sender->setMobile(['017XXYYZZAA','018XXYYZZAA']);
            // Set the message
            $sender->setMessage('helloooooooo boss!');

            // Enable queue if desired
            $sender->setQueue(true); // if you want to send SMS from queue

            // Set the configuration for the provider
            $sender->setConfig([
                'api_token' => 'api token goes here',
                'sid' => 'text',
                'csms_id' => 'sender_id'
            ]);

            // Send the SMS and get the status
            $status = $sender->send();

            //dd($status);
            // Check and handle the status
            if ($status) {
                //echo "SMS sent successfully!";
                return response()->json($status);
            } else {
                echo "Failed to send SMS.";
            }
        } catch (\Exception $e) {
            // Handle exceptions and display the error message
            echo "Error: " . $e->getMessage();
        }
    }
}
