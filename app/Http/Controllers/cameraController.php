<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\camera;
use App\Models\transaction;
use App\Models\client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use PDF;

class cameraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        // $client =  client::where('user_id',Auth::id())->first();
        // $client->transactions();
        // dd($client);
        $camera = camera::orderBy('camera_id', 'DESC')->get();
        return response()->json($camera);
    }

    public function getCameraAll()
    {   
        return view('camera.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $camera = new camera;
        $camera->model = $request->model;
        $camera->shuttercount = $request->shuttercount;
        $camera->quantity = $request->quantity;
        $camera->costs = $request->costs;

        $files = $request->file('uploads');
        $camera->image_path = 'images/'.$files->getClientOriginalName();
        $camera->save();
        Storage::put('/public/images/'.$files->getClientOriginalName(),file_get_contents($files));
        return response()->json(["success" => "Camera Created Successfully.", "camera" => $camera, "status" => 200]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  
        $camera = camera::find($id);
        return response()->json($camera);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {  
        $camera = camera::find($id);
        $camera->model = $request->model;
        $camera->shuttercount = $request->shuttercount;
        $camera->quantity = $request->quantity;
        $camera->costs = $request->costs;

        $files = $request->file('uploads');
        $camera->image_path = 'images/'.$files->getClientOriginalName();
        $camera->update();
        Storage::put('/public/images/'.$files->getClientOriginalName(),file_get_contents($files));
        return response()->json(["success" => "Camera Updated Successfully.", "camera" => $camera, "status" => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $camera = camera::findOrFail($id);

        if (File::exists("storage/" . $camera->image_path)) {
            File::delete("storage/" . $camera->image_path);
        }

        $camera->delete();

        $data = array('success' => 'deleted', 'code' => '200');
        return response()->json($data);
    }

    public function getCameraTransaction(){
        return view('transaction.camera-transaction');
    }

    public function postCheckout(Request $request){
        $cameras = json_decode($request->getContent(),true);
        Log::info(print_r($cameras, true));
          try {
            DB::beginTransaction();
            $transaction = new transaction();
            $client =  client::where(auth()->id())->first();
            // $try = DB::table('users')->rightJoin('client', 'client.user_id', '=', 'users.id')->where('users.id',auth()->id())->first();
            $transaction->client_id = $client->client_id;
            $transaction->date_of_rent = now();
            $transaction->payment_type = 'cash';
            $transaction->shipment_type = 'delivery';
            // $client =  client::find(1);
            // $client->transactions()->save($transaction);
            $transaction->save();
            
            foreach($cameras as $camera) {
               $id = $camera['camera_id'];
               $transaction->cameras()->attach($transaction->transaction_id,['quantity'=> $camera['quantity'],'camera_id'=>$id]);
               $stock = camera::find($id);
               $stock->quantity = $stock->quantity - $camera['quantity'];
               $stock->save();
            }
            
          }
        catch (\Exception $e) {
              DB::rollback();
              return response()->json(array('status' => 'Order failed','code'=>409,'error'=>$e->getMessage()));
        }
          DB::commit();
          return response()->json(array('status' => 'Order Success','code'=>200,'transaction id'=>$transaction->transaction_id));
    }

    public function getCameraReceipt(Request $request)
    {
        // $client = client::where('user_id',Auth::id())->first();
        $client =  client::find(1);
        $transactions = transaction::join('camera_transaction_line','transaction.transaction_id','camera_transaction_line.transaction_id')
        ->join('camera','camera.camera_id','camera_transaction_line.camera_id')
        ->select('transaction.transaction_id','camera_transaction_line.quantity','camera.model','camera.costs','camera.image_path')
        ->where('client_id',$client->client_id)
        ->orderBy('transaction.transaction_id', 'DESC')
        ->take("1")
        ->get(); 
        // dd($client, $transactions);
        return view('transaction.cam-receipt',compact('transactions'));
    }

    public function downloadCameraPDF(){
        // $client = client::where('user_id',Auth::id())->first();
        $client =  client::find(1);
        $transactions = transaction::join('camera_transaction_line','transaction.transaction_id','camera_transaction_line.transaction_id')
        ->join('camera','camera.camera_id','camera_transaction_line.camera_id')
        ->select('transaction.transaction_id','transaction.date_of_rent','transaction.status','camera.model','camera.costs')
        ->where('client_id',$client->client_id)
        ->orderBy('transaction.transaction_id', 'DESC')
        ->take("1")
        ->get(); 
        $pdf = PDF::loadView('camera-receipt', compact('transactions'));
        return $pdf->download('camera-receipt.pdf');
    }
}
