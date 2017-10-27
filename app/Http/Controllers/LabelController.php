<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use EasyPost;
use App;
use View;
use PDF;
use Dompdf\Dompdf;
use Response;

class LabelController extends Controller
{

    public function generateLabel()
    {

        $data=Request::all();
        //dd($data);
        \EasyPost\EasyPost::setApiKey('ajOHvmDFRcFhzktqnxsIAg');


        $to_address = \EasyPost\Address::create(
            array(
                "name"    =>  $data['name'],
                "street1" =>  $data['street1'],
                "street2" =>  $data['street2'],
                "city"    =>  $data['city'],
                "state"   =>  $data['state'],
                "zip"     =>  $data['zip'],
                "phone"   =>  $data['phone'],
            )
        );

        $from_address = \EasyPost\Address::create(
            array(
                "company"    =>  $data['from_company_name'],
                "street1" =>  $data['from_street1'],
                "street2" =>  $data['from_street2'],
                "city"    =>  $data['from_city'],
                "state"   =>  $data['from_state'],
                "zip"     =>  $data['from_zip'],
                "phone"   =>  $data['from_phone'],
            )
        );

        
        $parcel = \EasyPost\Parcel::create(
            array(
                "predefined_package" => "LargeFlatRateBox",
                "weight" => 76.9
            )
        );
        $shipment = \EasyPost\Shipment::create(
            array(
                "to_address"   => $to_address,
                "from_address" => $from_address,
                "parcel"       => $parcel
            )
        );

        $shipment->buy($shipment->lowest_rate());

        $shipment->insure(array('amount' => 100));
        //dd($shipment->postage_label);

        $label=$shipment->postage_label->label_url;

        return view('generate_label',compact('label'));

    }


    public function printLabel()
    {
        $data=Request::all();
        //dd($data);
        $label=$data['label'];
        //$label="https://easypost-files.s3-us-west-2.amazonaws.com/files/postage_label/20171027/9132449e65bb471eba41cbeacd92ec6d.png";

        $dompdf = new Dompdf(array('enable_remote' => true));
        $view=View::make('print_label',compact('label'));
        $html=$view->render();
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream();
    }
    // public function getLabel()
    // {
    //     $data=Request::all();
    //     //dd($data);
    //     $error=Usps::validate($data);
    //     //dd($error);
    //     if($error==0)
    //     {


    //         $verify = new \Usps\CityStateLookup('911TIER55706');
    //         // During test mode this seems not to always work as expected
    //         //$verify->setTestMode(true);
    //         // Add the zip code we want to lookup the city and state
    //         $verify->addZipCode('91730');
    //         // Perform the call and print out the results
    //         print_r($verify->lookup());
    //         echo "<br>";
    //         print_r($verify->getArrayResponse());

    //         echo "<br>";
    //         // Check if it was completed
    //         if ($verify->isSuccess()) {
    //             echo 'Done';
    //         } else {
    //             echo 'Error: '.$verify->getErrorMessage();
    //         }


    //         $rate = new \Usps\Rate('911TIER55706');
    //         // During test mode this seems not to always work as expected
    //         //$rate->setTestMode(true);
    //         // Create new package object and assign the properties
    //         // apartently the order you assign them is important so make sure
    //         // to set them as the example below
    //         // set the RatePackage for more info about the constants
    //         $package = new RatePackage();
    //         $package->setService(RatePackage::SERVICE_FIRST_CLASS);
    //         $package->setFirstClassMailType(RatePackage::MAIL_TYPE_LETTER);
    //         $package->setZipOrigination(91601);
    //         $package->setZipDestination(91730);
    //         $package->setPounds(0);
    //         $package->setOunces(3.5);
    //         $package->setContainer('');
    //         $package->setSize(RatePackage::SIZE_REGULAR);
    //         $package->setField('Machinable', true);
    //         // add the package to the rate stack
    //         $rate->addPackage($package);
    //         // Perform the request and print out the result
    //         print_r($rate->getRate());
    //         echo "<br>";
    //         print_r($rate->getArrayResponse());

    //         echo "<br>";
    //         // Was the call successful
    //         if ($rate->isSuccess()) {
    //             echo 'Done';
    //         } else {
    //             echo 'Error: '.$rate->getErrorMessage();
    //         }


    //         $label = new \Usps\PriorityLabel('911TIER55706');
    //         // During test mode this seems not to always work as expected
    //         $label->setTestMode(true);
    //         $label->setFromAddress('John', 'Doe', '', '5161 Lankershim Blvd', 'North Hollywood', 'CA', '91601', '# 204', '', '8882721214');
    //         $label->setToAddress('Vincent', 'Gabriel', '', '230 Murray St', 'New York', 'NY', '10282');
    //         $label->setWeightOunces(1);
    //         $label->setField(36, 'LabelDate', '03/12/2014');
    //         //$label->setField(32, 'SeparateReceiptPage', 'true');
    //         // Perform the request and return result
    //         $label->createLabel();
    //         //print_r($label->getArrayResponse());
    //         //print_r($label->getPostData());
    //         //var_dump($label->isError());
    //         // See if it was successful
    //         if ($label->isSuccess()) {
    //             //echo 'Done';
    //             //echo "\n Confirmation:" . $label->getConfirmationNumber();
    //             $label = $label->getLabelContents();
    //             if ($label) {
    //                 $contents = base64_decode($label);
    //                 header('Content-type: application/pdf');
    //                 header('Content-Disposition: inline; filename="label.pdf"');
    //                 header('Content-Transfer-Encoding: binary');
    //                 header('Content-Length: '.strlen($contents));
    //                 echo $contents;
    //                 exit;
    //             }
    //         } else {
    //             echo 'Error: '.$label->getErrorMessage();
    //         }

    //         // $label = new \Usps\OpenDistributeLabel('911TIER55706');
    //         // $label->setFromAddress('John', 'Doe', '', '5161 Lankershim Blvd', 'North Hollywood', 'CA', '91601', '# 204');
    //         // $label->setToAddress('Vincent Gabriel', '5440 Tujunga Ave', 'North Hollywood', 'CA', '91601', '707');
    //         // $label->setWeightOunces(1);
    //         // // Perform the request and return result
    //         // $label->createLabel();
    //         // //print_r($label->getArrayResponse());
    //         // print_r($label->getPostData());
    //         // //var_dump($label->isError());
    //         // // See if it was successful
    //         // if ($label->isSuccess()) {
    //         //     echo 'Done';
    //         //     echo "\n Confirmation:" . $label->getConfirmationNumber();
    //         //     $label = $label->getLabelContents();
    //         //     if ($label) {
    //         //         $contents = base64_decode($label);
    //         //         header('Content-type: application/pdf');
    //         //         header('Content-Disposition: inline; filename="label.pdf"');
    //         //         header('Content-Transfer-Encoding: binary');
    //         //         header('Content-Length: ' . strlen($contents));
    //         //         echo $contents;
    //         //         exit;
    //         //     }
    //         // } else {
    //         //     echo 'Error: ' . $label->getErrorMessage();
    //         // }       
            
    //     }
    //     else
    //     {
    //         echo "Error";
    //     }
    // }
}
