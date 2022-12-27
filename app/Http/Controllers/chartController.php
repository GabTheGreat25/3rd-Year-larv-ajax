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

    public function salesChart() {
        $sales = DB::table('camera as c')
                    ->join('camera_transaction_line as cl', 'c.camera_id', '=', 'cl.camera_id')
                    ->join('transaction as tr', 'cl.transaction_id', '=', 'tr.transaction_id')
                    ->select(DB::raw('monthname(tr.date_of_rent) as month, sum(cl.quantity * c.costs) as total'))
                    ->groupBy('tr.date_of_rent')
                    ->pluck('total','month')
                    ->all();
        $labels = (array_keys($sales));
    
        $data= array_values($sales);
        return response()->json(array('data' => $data, 'labels' => $labels));
    }

    public function accChart() {
        $sales = DB::table('accessories as a')
                    ->join('accessories_transaction_line as al', 'a.accessories_id', '=', 'al.accessories_id')
                    ->join('transaction as tr', 'al.transaction_id', '=', 'tr.transaction_id')
                    ->select(DB::raw('a.description as items, sum(al.quantity) as total'))
                    ->groupBy('a.description')
                    ->pluck('total','items')
                    ->all();
        $labels = (array_keys($sales));
    
        $data= array_values($sales);
        return response()->json(array('data' => $data, 'labels' => $labels));
    }
}
