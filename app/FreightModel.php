<?php

namespace App;

use DB;

class FreightModel
{
    public function get_all_orders(){
        $orders = DB::select('select * from frieghtorders');
        return $orders;
    }    
}
