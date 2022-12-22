<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class chartController extends Controller
{
    public function operatorChart() {
        $customer = DB::table('operator as o')
                    ->join('services as s', 'o.operator_id', 's.operator_id')
                    ->groupBy('o.full_name')
                    ->orderBy('total', 'ASC')
                    ->pluck(DB::raw('count(o.full_name) as total'),'o.full_name')->all();
        $labels = (array_keys($customer));
        
        $data= array_values($customer);
        return response()->json(array('data' => $data, 'labels' => $labels));
    }

    public function getOperatorChart(){
        return view('charts.index');
    }
}
