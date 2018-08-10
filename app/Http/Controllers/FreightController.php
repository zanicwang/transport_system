<?php

namespace App\Http\Controllers;
use FarhanWazir\GoogleMaps\GMaps;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\FreightModel;

    
// ajaxchangecolor(this.value); location.href=\'?color=\' + this.value
class FreightController extends Controller {

    protected $gmap;
    
    public function __construct(GMaps $gmap){
        $this->gmap = $gmap;
    }
    

	//update marker icons by changing in select option
   public function update_delivered(Request $request){
		$model = new FreightModel;
		$update_town = $request->town;
		$update_address = $request->address;
		//var_dump($update_town);exit;
		$color = $request->color;
		$results = $model->get_update_orders($update_town, $update_address, $color);
		$config['center'] = '7430, lkast';
        $config['zoom'] = 9;
        $this->gmap->initialize($config);

		for( $i=0 ; $i<count($results); $i++){
            $marker['position'] = $results[$i]->address.', '.$results[$i]->zipcode.'  '.$model->filter_address($results[$i]->town).', Denmark';
            $marker['icon'] = $model->locate_icons_update($results[$i]->town, $results[$i]->color);
            $this->gmap->add_marker($marker);
        }
        $map = $this->gmap->create_map();
        $data['map'] = $map;
        $data['orders'] = $results;
        return view('layouts.default', $data);
   }



  /*     //get address of delivery point
        $model = new FreightModel; 
        $results = $model->get_all_orders();

		$model->get_status_town($which_town, $asign_status);
        //configuration of google maps
        //$config = array();
        $config['center'] = '7430, lkast';
        $config['zoom'] = 9;
        $this->gmap->initialize($config);
        
        //info window
        $info_content = 
        '<span>Asigned to Area </span>'.
        '<select id="asigned_area" onchange="">'.
            '<option>Aarhus</option>'.
            '<option>Ringkøbing</option>'.
            '<option>Videbæk</option>'.
            '<option>Varde</option>'.
            '<option>Ulfborg</option>'.
            '<option>Viborg</option>'.
        '</select>'.
        '<br>'.
        '<span>Asigned to Route </span>'.
        '<select id="asigned_route" onChange=""">'.
            '<option style="background-color:#912d2d">red</option>'.
            '<option style="background-color:#e1d27d">yellow</option>'.
            '<option style="background-color:#a3e6be">green</option>'.
            '<option style="background-color:#c199df">puple</option>'.
            '<option style="background-color:#c8e6a3"></option>'.
            '<option style="background-color:#e1d27d"></option>'.
        '</select>'.
        '<br><br>';

        
        for( $i=0 ; $i<count($results); $i++){
            $marker['position'] = $results[$i]->address.', '.$results[$i]->zipcode.'  '.$model->filter_address($results[$i]->town).', Denmark';
			
				$marker['infowindow_content'] = 
              $info_content.
              '<p>'.
              $results[$i]->name.'<br>'.
              $results[$i]->address.'<br>'.
				$results[$i]->zipcode.' '.
				$model->filter_address($results[$i]->town).'<br>'.
				$results[$i]->phone.
				'</p>'.
				'<button onclick="location.href=`test\?color=black\`"								class="go_btn">GO</button>';
            $marker['icon'] = $model->locate_icons_each_town($results[$i]->town, 'all', 1);
			//var_dump($marker['icon']);
            $this->gmap->add_marker($marker);
        }*/


	//display default
	public function index(Request $request){
		$model = new FreightModel; 
		$results = $model->get_all_orders();
        $config['center'] = 'lkast, Denmark';
        $config['zoom'] = 9;
        $this->gmap->initialize($config);

		$info_content = 
        '<span>Asigned to Area </span>'.
        '<select id="asigned_area" onchange="">'.
            '<option>Aarhus</option>'.
            '<option>Ringkøbing</option>'.
            '<option>Videbæk</option>'.
            '<option>Varde</option>'.
            '<option>Ulfborg</option>'.
            '<option>Viborg</option>'.
        '</select>'.
        '<br>'.
        '<span>Asigned to Route </span>'.
        '<select id="asigned_route" onChange=""">'.
            '<option style="background-color:#912d2d">red</option>'.
            '<option style="background-color:#e1d27d">yellow</option>'.
            '<option style="background-color:#a3e6be">green</option>'.
            '<option style="background-color:#c199df">puple</option>'.
            '<option style="background-color:#c8e6a3"></option>'.
            '<option style="background-color:#e1d27d"></option>'.
        '</select>'.
        '<br><br>';

		for( $i=0 ; $i<count($results); $i++){
            $marker['position'] = $results[$i]->address.', '.$results[$i]->zipcode.'  '.$model->filter_address($results[$i]->town).', Denmark';
			$circle['center'] = $marker['position'];
			$circle['fillOpacity'] = "0.1";
			$circle['strokeOpacity'] = "0.1";
            $marker['icon'] = $model->locate_icons_default($results[$i]->town);
			$marker['infowindow_content'] = 
              $info_content.
              '<p>'.
              $results[$i]->name.'<br>'.
              $results[$i]->address.'<br>'.
				$results[$i]->zipcode.' '.
				$model->filter_address($results[$i]->town).'<br>'.
				$results[$i]->phone.
				'</p>'
				'<button onclick="location.href=`\?color=black\`"								class="go_btn">GO</button>';
            $this->gmap->add_marker($marker);
			$circle['radius'] = '10000';
			$this->gmap->add_circle($circle);
        }
        $map = $this->gmap->create_map();
        $data['map'] = $map;
        $data['orders'] = $results;
        return view('layouts.default', $data);
	}

	//remove delivery points after click on leftsidebar
	public function remove_sidebar(Request $request){
		$model = new FreightModel; 
		$remove_town = $request->town;
		$results = $model->get_remove_orders($remove_town);
        $config['center'] = '7430, lkast';
        $config['zoom'] = 9;
        $this->gmap->initialize($config);
        for( $i=0 ; $i<count($results); $i++){
            $marker['position'] = $results[$i]->address.', '.$results[$i]->zipcode.'  '.$model->filter_address($results[$i]->town).', Denmark';
            $marker['icon'] = $model->locate_icons_default($results[$i]->town);
            $this->gmap->add_marker($marker);
        }
        $map = $this->gmap->create_map();
        $data['map'] = $map;
        $data['orders'] = $results;
        return view('layouts.default', $data);
	}

   public function test(Request $request){
   }
}