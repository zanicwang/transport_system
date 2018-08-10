<?php

namespace App;

use DB;


class FreightModel
{
    public function __constructor(){
        
    }
    public function get_all_orders(){
        $orders = DB::select('select * from freightorders');
        return $orders;
    }    

	public function get_remove_orders($remove_town){
		$orders = DB::select('select * from freightorders where town <> "'.$remove_town.'"');
		return $orders;
	}

	public function get_update_orders($update_town, $update_address, $color){
		//var_dump($update_town, $color);exit;
		DB::table('freightorders')
            ->where('town', $update_town)->where('address', $update_address)
            ->update(['color' => $color]);
		$orders = DB::select('select * from freightorders');
        return $orders;
	}

    //convert zip address to full
    public function filter_address($string){
        // var_dump($string);exit;
        if($string == "aar") { $return_string = "Aarhus"; } 
        else if($string == "ulf") { $return_string = "Ulfborg"; } 
        else if($string == "vid") { $return_string = "Videbak"; }
        else if($string == "vib") { $return_string = "Viborg"; }
        else if($string == "rin") { $return_string = "Ringkobing"; }
        else if($string == "var") { $return_string = "Varde"; }
		else if($string == "Aarhus") { $return_string = "aar"; } 
        else if($string == "Ulfborg") { $return_string = "ulf"; }
        else if($string == "Viborg") { $return_string = "vib"; }
        else if($string == "Ringkobing") { $return_string = "rin"; }
        else if($string == "Varde") { $return_string = "var"; }
        else if($string == "Videbak") { $return_string = "vid"; }
        else { $return_string = ""; }
        
        return $return_string;
    }
    
    public function locate_icons_default($town){

        $public_url = "http://127.0.0.1:8000/icon/";
        $icon = $public_url.$town."/default.png";
		return $icon;
	}

	public function locate_icons_update($town, $color){
		$public_url = "http://127.0.0.1:8000/icon/";
		$icon = $public_url.$town."/".$color.".png";
		return $icon;
	}


//  display all icons on/off
/*		if($which_town == 'all') {
	if($asign_status == 1){
		switch($town){
			case 'aar':
				$icon = $public_url.$town."/".$color.".png";
				break;
			case 'vid':
				$icon = $public_url.$town."/".$color.".png";
				break;
			case 'vib':
				$icon = $public_url.$town."/".$color.".png";
				break;
			case 'var':
				$icon = $public_url.$town."/".$color.".png";
				break;
			case 'rin':
				$icon = $public_url.$town."/".$color.".png";
				break;
			case 'ulf':
				$icon = $public_url.$town."/".$color.".png";
				break;
			default:
				$icon = $public_url.$town."/".$color.".png";
				break;
		}
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
	} else {
		switch($town){
			case 'aar':
				$icon = $public_url."ArrowDown/Arrow-Down-White-NS-12.png";
				break;
			case 'vid':
				$icon = $public_url."Fist/Fist-White-NS-12.png";
				break;
			case 'vib':
				$icon = $public_url."Burglar/Burglar-White-NS-12.png";
				break;
			case 'var':
				$icon = $public_url."Juvenile/Juvenile-White-NS-12.png";
				break;
			case 'rin':
				$icon = $public_url."Offenders/Offenders-White-NS-12.png";
				break;
			case 'ulf':
				$icon = $public_url."Pedestrian/Ped-White-NS-12.png";
				break;
			default:
				$icon = $public_url."Vehicle/Vehicle-White-NS-12.png";
				break;
		}
	}
}
//shows town
else if($which_town != 'all'){
	if($asign_status == 1){
		switch($town){
			case 'aar':
				$icon = $public_url."ArrowDown/Arrow-Down-Black-NS-1.png";
				break;
			case 'vid':
				$icon = $public_url."Fist/Fist-Black-NS-2.png";
				break;
			case 'vib':
				$icon = $public_url."Burglar/Burglar-Black-NS-3.png";
				break;
			case 'var':
				$icon = $public_url."Juvenile/Juvenile-Black-NS-4.png";
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
	} else {
		switch($town){
			case 'aar':
				$icon = $public_url."ArrowDown/Arrow-Down-White-NS-12.png";
				break;
			case 'vid':
				$icon = $public_url."Fist/Fist-White-NS-2.png";
				break;
			case 'vib':
				$icon = $public_url."Burglar/Burglar-White-NS-3.png";
				break;
			case 'var':
				$icon = $public_url."Juvenile/Juvenile-White-NS-4.png";
				break;
			case 'rin':
				$icon = $public_url."Offenders/Offenders-White-NS-5.png";
				break;
			case 'ulf':
				$icon = $public_url."Pedestrian/Ped-White-NS-6.png";
				break;
			default:
				$icon = $public_url."Vehicle/Vehicle-White-NS-12.png";
				break;
		}
			var_dump($town);exit;
	}
}

return $icon;*/

}
