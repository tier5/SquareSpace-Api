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

        \EasyPost\EasyPost::setApiKey("ajOHvmDFRcFhzktqnxsIAg");

          $order = \EasyPost\Order::retrieve("order_...");
          dd($order);

  ));

    }
    
}