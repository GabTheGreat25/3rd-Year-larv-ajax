<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\operator;
use App\Models\camera;
use App\Models\accessories;
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

    public function searchCamTransaction(Request $request){
        if($request->ajax())
        {
            $search = '';
            $query = $request->get('query');
            if($query != '') {
                // $try = DB::table('accessories as a')
                //     ->leftJoin('accessories_transaction_line as al', 'a.accessories_id', '=', 'al.accessories_id')
                //     ->leftJoin('transaction as tr', 'al.transaction_id', '=', 'tr.transaction_id');

                $data = camera::join('camera_transaction_line as cl', 'cl.camera_id', '=', 'camera.camera_id')
                    ->join('transaction as tr', 'tr.transaction_id', '=', 'cl.transaction_id')
                    ->select('camera.*','cl.quantity','tr.transaction_id','tr.date_of_rent','tr.payment_type','tr.shipment_type','tr.status')
                    ->where('model', 'like', '%'.$query.'%')
                    ->orderBy('camera_id', 'desc')
                    ->get();
            } else {
            //    $try = DB::table('accessories as a')
            //         ->leftJoin('accessories_transaction_line as al', 'a.accessories_id', '=', 'al.accessories_id')
            //         ->leftJoin('transaction as tr', 'al.transaction_id', '=', 'tr.transaction_id');

                $data = camera::join('camera_transaction_line as cl', 'cl.camera_id', '=', 'camera.camera_id')
                    ->join('transaction as tr', 'tr.transaction_id', '=', 'cl.transaction_id')
                    ->select('camera.*','cl.quantity','tr.transaction_id','tr.date_of_rent','tr.payment_type','tr.shipment_type','tr.status')
                    ->orderBy('camera_id', 'desc')
                    ->get();
            }
         
            $total_search = $data->count();
            if($total_search > 0){
                foreach($data as $row)
                {
                    $search .= '
                    <tr>
                    <td>'.$row->transaction_id.'</td>
                    <td>'.$row->model.'</td>
                    <td>'.$row->shuttercount.'</td>
                    <td>'.$row->costs.'</td>
                    <td><img width = 100px height = 100px src = storage/'.$row->image_path.'></td>
                    <td>'.$row->quantity.'</td>
                    <td>'.$row->date_of_rent.'</td>
                    <td>'.$row->payment_type.'</td>
                    <td>'.$row->shipment_type.'</td>
                    <td>'.$row->status.'</td>
                    </tr>
                    ';
                }
            } else {
                $search = '
                <tr>
                    <td align="center" colspan="10">No Data Found</td>
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

    public function getSearchCamTransaction(){
        return view('search.searchCamTransaction');
    }

    public function searchAccTransaction(Request $request){
        if($request->ajax())
        {
            $search = '';
            $query = $request->get('query');
            if($query != '') {
                $data = accessories::join('accessories_transaction_line as al', 'al.accessories_id', '=', 'accessories.accessories_id')
                    ->join('transaction as tr', 'tr.transaction_id', '=', 'al.transaction_id')
                    ->select('accessories.*','al.quantity','tr.transaction_id','tr.date_of_rent','tr.payment_type','tr.shipment_type','tr.status')
                    ->where('description', 'like', '%'.$query.'%')
                    ->orderBy('accessories_id', 'desc')
                    ->get();
            } else {
                $data = accessories::join('accessories_transaction_line as al', 'al.accessories_id', '=', 'accessories.accessories_id')
                    ->join('transaction as tr', 'tr.transaction_id', '=', 'al.transaction_id')
                    ->select('accessories.*','al.quantity','tr.transaction_id','tr.date_of_rent','tr.payment_type','tr.shipment_type','tr.status')
                    ->orderBy('accessories_id', 'desc')
                    ->get();
            }
         
            $total_search = $data->count();
            if($total_search > 0){
                foreach($data as $row)
                {
                    $search .= '
                    <tr>
                    <td>'.$row->transaction_id.'</td>
                    <td>'.$row->description.'</td>
                    <td>'.$row->costs.'</td>
                    <td><img width = 100px height = 100px src = storage/'.$row->image_path.'></td>
                    <td>'.$row->quantity.'</td>
                    <td>'.$row->date_of_rent.'</td>
                    <td>'.$row->payment_type.'</td>
                    <td>'.$row->shipment_type.'</td>
                    <td>'.$row->status.'</td>
                    </tr>
                    ';
                }
            } else {
                $search = '
                <tr>
                    <td align="center" colspan="9">No Data Found</td>
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

    public function getSearchAccTransaction(){
        return view('search.searchAccTransaction');
    }
}
