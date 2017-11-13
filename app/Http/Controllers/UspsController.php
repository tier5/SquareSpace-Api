<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

class UspsController extends Controller
{
    var $params = array(); //Stores the object representation of XML data
    var $root = NULL;
    var $global_index = -1;
    var $fold = false;

    public function index()
    {

        $USPSResponse = $this->USPSLabel();
        $USPSLabel = $USPSResponse['DeliveryConfirmationV3.0Response']['DeliveryConfirmationLabel']['VALUE'];
        $label= base64_decode($USPSLabel);


        $file = fopen("label.pdf", "w") or die("Unable to open file!");
        fwrite($file, $label);
        fclose($file);

        $filename = 'label.pdf';

        return Response::make(file_get_contents($filename), 200, [
             'Content-Type' => 'application/pdf',
             'Content-Disposition' => 'inline; filename="'.$filename.'"',
             'Content-Length' => strlen($label)
        ]);

    }

    public function USPSLabel()
    {

        $userName = ''; // Your USPS Username
        $FromName = 'EasyPost';
        $FromAddress2 = '118 2nd Street';
        $FromCity = 'San Francisco';
        $FromState = 'CA';
        $FromZip5 = '94105';

        $ToName = 'Dr. Steve Brule';
        $ToAddress2 = '179 N Harbor Dr';
        $ToCity = 'Redondo Beach';
        $ToState = 'CA';
        $ToZip5 = '90277';

        $weightOunces = 5;



        $url = "https://Secure.ShippingAPIs.com/ShippingAPI.dll";
        $ch = curl_init();

        // set the target url
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // parameters to post
        curl_setopt($ch, CURLOPT_POST, 1);

        $data = "API=DeliveryConfirmationV3&XML=<DeliveryConfirmationV3.0Request USERID='911TIER55706'>
            <Option>1</Option>
            <ImageParameters />
            <FromName>$FromName</FromName>
            <FromFirm />
            <FromAddress1 />
            <FromAddress2>$FromAddress2</FromAddress2>
            <FromCity>$FromCity</FromCity>
            <FromState>$FromState</FromState>
            <FromZip5>$FromZip5</FromZip5>
            <FromZip4 />
            <ToName>$ToName</ToName>
            <ToFirm />
            <ToAddress1 />
            <ToAddress2>$ToAddress2</ToAddress2>
            <ToCity>$ToCity</ToCity>
            <ToState>$ToState</ToState>
            <ToZip5>$ToZip5</ToZip5>
            <ToZip4 />
            <WeightInOunces>$weightOunces</WeightInOunces>
            <ServiceType>Priority</ServiceType>
            <POZipCode />
            <ImageType>PDF</ImageType>
            <LabelDate />
            </DeliveryConfirmationV3.0Request>";

        // send the POST values to USPS
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $result = curl_exec($ch);
        $data = strstr($result, '<?');


        //$xmlParser = new uspsxmlParser();
        $fromUSPS = $this->xmlparser($data);
        $fromUSPS = $this->getData();

        curl_close($ch);
        return $fromUSPS;
    }



    /* Constructor for the class
    * Takes in XML data as input( do not include the <xml> tag
    */
    function xmlparser($input, $xmlParams = array(XML_OPTION_CASE_FOLDING => 0))
    {
        $xmlp = xml_parser_create();
        foreach ($xmlParams as $opt => $optVal) {
            switch ($opt) {
                case XML_OPTION_CASE_FOLDING:
                    $this->fold = $optVal;
                    break;
                default:
                    break;
            }
            xml_parser_set_option($xmlp, $opt, $optVal);
        }

        if (xml_parse_into_struct($xmlp, $input, $vals, $index)) {
            $this->root = $this->_foldCase($vals[0]['tag']);
            $this->params = $this->xml2ary($vals);
        }
        xml_parser_free($xmlp);
    }

    function _foldCase($arg)
    {
        return ($this->fold ? strtoupper($arg) : $arg);
    }


    function xml2ary($vals)
    {

        $mnary = array();
        $ary =& $mnary;
        foreach ($vals as $r) {
            $t = $r['tag'];
            if ($r['type'] == 'open') {
                if (isset($ary[$t]) && !empty($ary[$t])) {
                    if (isset($ary[$t][0])) {
                        $ary[$t][] = array();
                    } else {
                        $ary[$t] = array($ary[$t], array());
                    }
                    $cv =& $ary[$t][count($ary[$t]) - 1];
                } else {
                    $cv =& $ary[$t];
                }
                $cv = array();
                if (isset($r['attributes'])) {
                    foreach ($r['attributes'] as $k => $v) {
                        $cv[$k] = $v;
                    }
                }

                $cv['_p'] =& $ary;
                $ary =& $cv;

            } else if ($r['type'] == 'complete') {
                if (isset($ary[$t]) && !empty($ary[$t])) { // same as open
                    if (isset($ary[$t][0])) {
                        $ary[$t][] = array();
                    } else {
                        $ary[$t] = array($ary[$t], array());
                    }
                    $cv =& $ary[$t][count($ary[$t]) - 1];
                } else {
                    $cv =& $ary[$t];
                }
                if (isset($r['attributes'])) {
                    foreach ($r['attributes'] as $k => $v) {
                        $cv[$k] = $v;
                    }
                }
                $cv['VALUE'] = (isset($r['value']) ? $r['value'] : '');

            } elseif ($r['type'] == 'close') {
                $ary =& $ary['_p'];
            }
        }

        $this->_del_p($mnary);
        return $mnary;
    }

// _Internal: Remove recursion in result array
    function _del_p(&$ary)
    {
        foreach ($ary as $k => $v) {
            if ($k === '_p') {
                unset($ary[$k]);
            } else if (is_array($ary[$k])) {
                $this->_del_p($ary[$k]);
            }
        }
    }

    /* Returns the root of the XML data */
    function GetRoot()
    {
        return $this->root;
    }

    /* Returns the array representing the XML data */
    function GetData()
    {
        return $this->params;
    }

}
?>
