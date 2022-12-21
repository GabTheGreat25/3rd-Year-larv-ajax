<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\service;
use App\Models\operator;
use DB;
use View;

class searchController extends Controller
{
    public function searchService(Request $request){
        if($request->ajax())
        {
            $search = '';
            $query = $request->get('query');
            if($query != '') {
                $data = operator::join('services','operator.operator_id','services.operator_id')
                    ->select('operator.*','services.service_type','services.date_of_service','services.price','services.image_path')
                    ->where('full_name', 'like', '%'.$query.'%')
                    ->orWhere('contact_number', 'like', '%'.$query.'%')
                    ->orderBy('operator_id', 'desc')
                    ->get();
                
            } else {
                $data = operator::join('services','operator.operator_id','services.operator_id')
                    ->select('operator.*','services.service_type','services.date_of_service','services.price','services.image_path')
                    ->orderBy('operator_id', 'desc')
                    ->get();
            }
         
            $total_search = $data->count();
            if($total_search > 0){
                foreach($data as $row)
                {
                    $search .= '
                    <tr>
                    <td>'.$row->service_type.'</td>
                    <td>'.$row->date_of_service.'</td>
                    <td>'.$row->price.'</td>
                    <td><img width = 100px height = 100px src = storage/'.$row->image_path.'></td>
                    </tr>
                    ';
                }
            } else {
                $search = '
                <tr>
                    <td align="center" colspan="5">No Data Found</td>
                </tr>
                ';
            }
            $data = array(
                'table_data'  => $search,
                'total_data'  => $total_search
            );
            echo json_encode($data);
        }

    }

    public function getSearchService(){
        return view('search.searchService');
    }
}
