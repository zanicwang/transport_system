<?php

namespace App\Http\Controllers;
use FarhanWazir\GoogleMaps\GMaps;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\FreightModel;

    
class FreightController extends Controller {

    protected $gmap;
    
    public function __construct(GMaps $gmap){
        $this->gmap = $gmap;
    }
    
   public function index(Request $request){

       //get address of delivery point
        $model = new FreightModel; 
        $results = $model->get_all_orders();

        //get route information from database and set marker icon
        $marker_icon = array();
        for($i = 0 ; $i < count($results) ; $i++){
            $marker_icon[$i] = $model->locate_icons_each_town($results[$i]->town);
        }
        
        
        //configuration of google maps
        $config = array();
        $config['center'] = 'lkast, Denmark';
        $config['zoom'] = 9;
        // $config['scrollwheel'] = false;
        // $config['geocodeCaching'] = true;
        
        $this->gmap->initialize($config);
        
        //info window
        // get option background color : this.options[this.selectedIndex].style.backgroundColor
        // ajaxchangecolor(this.value); location.href=\'?color=\' + this.value+
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

            $marker = array();
        for( $i=0 ; $i<count($results); $i++){
            
            $marker['position'] = $results[$i]->zipcode.', '.$model->filter_address($results[$i]->town);
            $marker['infowindow_content'] = 
                $info_content.
                '<p>'.
                    $results[$i]->name.'<br>'.
                    $results[$i]->address.'<br>'.
                    $results[$i]->zipcode.' '.
                    $model->filter_address($results[$i]->town).'<br>'.
                    $results[$i]->phone.
                '</p>'.
                '<button onclick="location.href=`test\?color=black\`" class="go_btn">GO</button>';
            $marker['title'] = "Asigned to Area";
            $marker['icon'] = $marker_icon[$i];
            
            // $marker['onclick'] = "";
            $this->gmap->add_marker($marker);
        }

        // $marker['position'] = '7000, Aarhus';
        // $marker['infowindow_content'] = '<p>Hello</p>';
        // $marker['onclick'] = 'alert()';
        // $marker['icon'] = 'http://labs.google.com/ridefinder/images/mm_20_gray.png';
        // $this->gmap->add_marker($marker);

        $map = $this->gmap->create_map();
        $data['map'] = $map;
        $data['orders'] = $results;
        return view('layouts.default', $data);
   }

   public function test(Request $request){
   }
}