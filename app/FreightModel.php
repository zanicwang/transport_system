<?php

namespace App;

use DB;


class FreightModel
{
    public function __constructor(){
        
    }
    public function get_all_orders(){
        $orders = DB::select('select * from frieghtorders');
        return $orders;
    }    

    //convert zip address to full
    public function filter_address($string){
        // var_dump($string);exit;
        $return_string = "";
        if($string == "aar") { $return_string = "Aarhus"; } 
        else if($string == "ulf") { $return_string = "Ulfborg"; } 
        else if($string == "vid") { $return_string = "Videbæk"; }
        else if($string == "vib") { $return_string = "Viborg"; }
        else if($string == "rin") { $return_string = "Ringkøbing"; }
        else if($string == "var") { $return_string = "Varde"; }
        else { $return_string = ""; }
        
        return $return_string;
    }
    
    public function locate_icons_each_town($town){
        
        $public_url = "http://127.0.0.1:8000/icon/";
        $icon = array();
        //  var_dump($town);exit;
        switch($town){
            case 'aar':
                $icon = $public_url."ArrowDown/Arrow-Down-Black-NS-1.png";
                break;
            case 'vid':
                $icon = $public_url."Fist/Fist-Black-NS-3.png";
                break;
            case 'vib':
                $icon = $public_url."Burglar/Burglar-Black-NS-4.png";
                break;
            case 'var':
                $icon = $public_url."Juvenile/Juvenile-Black-NS-2.png";
                break;
            case 'rin':
                $icon = $public_url."Offenders/Offenders-Black-NS-5.png";
                break;
            case 'ulf':
                $icon = $public_url."Pedestrian/Ped-Black-NS-6.png";
                break;
            default:
                $icon = $public_url."Vehicle/Vehicle-White-NS-12.png";
                break;
        }
        return $icon;
    }

}
