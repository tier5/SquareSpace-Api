<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Usps;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return redirect('https://tools.usps.com/go/ScheduleAPickupAction!input.action');
    }

    /*to print the label */
    public function getOrderDetails()
    {
      // EasyPost\EasyPost::setApiKey("ajOHvmDFRcFhzktqnxsIAg");
      try{
         \EasyPost\EasyPost::setApiKey("ajOHvmDFRcFhzktqnxsIAg");
          $order = \EasyPost\Order::all();
        // dd($order);
          return view('order-details',compact('order'));
          }
          catch(\EasyPost\Error $e)
          {
             echo $e->ecode;
          }


    }
    public function createOrder()
    {
        \EasyPost\EasyPost::setApiKey("ajOHvmDFRcFhzktqnxsIAg");
        $to_address = 
    array(
        "name"    => "Dirk Diggler",
        "street1" => "388 Townsend St",
        "street2" => "Apt 20",
        "city"    => "San Francisco",
        "state"   => "CA",
        "zip"     => "94107",
        "phone"   => "415-456-7890"
    );
    $from_address = 
    array(
        "company" => "Simpler Postage Inc",
        "street1" => "764 Warehouse Ave",
        "city"    => "Kansas City",
        "state"   => "KS",
        "zip"     => "66101",
        "phone"   => "620-123-4567"
    
);


     $order = \EasyPost\Order::create(array(
    "to_address" => $to_address,
    "from_address" => $from_address,
    "shipments" => array(
        array(
            "parcel" => array(
                "predefined_package" => "FedExBox",
                "weight" => 10.2
            )
        ),
        array(
            "parcel" => array(
                "predefined_package" => "FedExBox",
                "weight" => 17.5
            )
        ),
    ),
));
    }
    
}