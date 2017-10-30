<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request;
use EasyPost;
use Session;
use App;
use View;
use PDF;

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

    /*to create the order */
    public function create()
    {
         try 
         {
            \EasyPost\EasyPost::setApiKey("ajOHvmDFRcFhzktqnxsIAg");
            $data=Request::all();
            $to_address= json_decode($data['to_address'],true);
            $from_address= json_decode($data['from_address'],true);
            $shipment_id=$data['shipment_id'];
            //dd($to_address);
            $shipment = \EasyPost\Shipment::retrieve($shipment_id);
            $parcel=  \EasyPost\Parcel::retrieve($shipment->parcel->id);
            //dd($shipment);
            /*for creating new order */
            //dd($shipment->parcel->id);
            $order = \EasyPost\Order::create(
              array(
                "to_address"   => $to_address,
                "from_address" => $from_address,
                "shipments"    => array(
                    array(
                      "parcel" => $parcel
                    )
                  )
              ));
            
            $shipment->order_id=$order->id;

            $orders = \EasyPost\Order::all();
            Session::flash('success','Order generated successfully');
            return view('order-details',compact('orders'));
           
         } 
         catch (\Exception $e) 
         {
            $status=$e->getHttpStatus();
            //dd($status);
            $message=$e->getMessage();
            $error="\nStatus: ".$status."\n".$message;
            if (!empty($e->param)) {
                $error=$error."\nInvalid param: {$e->param}";
            }
            Session::flash('error',$error);
            return redirect('/order-details');
         }
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
     dd($order);
    }
    
}