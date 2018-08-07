<?php

namespace App\Http\Controllers;
use FarhanWazir\GoogleMaps\GMaps;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\FreightModel;

//convert zip address to full
function filter_address($string){
    $return_string = "";
    if($string == "aar") { $return_string = "Aarhan"; } 
    else if($string == "ulf") { $return_string = "Ulfborg"; } 
    else if($string == "vid") { $return_string = "Videbak"; }
    else if($string == "vib") { $return_string = "Viborg"; }
    else if($string == "rin") { $return_string = "Ringkobin"; }
    else if($string == "var") { $return_string = "Varde"; }
    else { $return_string = ""; }
    
    return $return_string;
}

class FreightController extends Controller {

    protected $gmap;
    
    
    public function __construct(GMaps $gmap){
        $this->gmap = $gmap;
        
    }

   public function index(Request $request){

       //get address of delivery point
        $orders = new FreightModel; 
        $results = $orders->get_all_orders();
        
        //configuration of google maps
        // $config = array();
        $config['center'] = 'lkast, Denmark';
        $config['zoom'] = 9;
        // $config['scrollwheel'] = false;
        // $config['geocodeCaching'] = true;
        
        $this->gmap->initialize($config);

        //draw icons on the map
        
        for( $i=0 ; $i<count($results); $i++){
            
            $marker = array();
            $marker['position'] = $results[$i]->zipcode.', '.filter_address($results[$i]->town);
            $marker['infowindow_content'] = $results[$i]->name.', '.$results[$i]->address.', '.$results[$i]->zipcode.', '.filter_address($results[$i]->town).', '.$results[$i]->phone;            $marker['onclick'] = '';
            $marker['title'] = "Asigned to Area";
            $this->gmap->add_marker($marker);
        }

        // $marker['position'] = '7171, Aarhus';
        // $marker['infowindow_content'] = '7171, Denmark';
        // $marker['onclick'] = 'alert()';
        // $marker['icon'] = 'image url';
        // $this->gmap->add_marker($marker);


        $map = $this->gmap->create_map();
        
        $data['map'] = $map;
        $data['orders'] = $results;
        return view('layouts.default', $data);
   }
}