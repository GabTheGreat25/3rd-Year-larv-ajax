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
            // $try = DB::table('client')->leftJoin('users', 'users.id', '=', 'client.user_id')->orderBy("client.created_at", "DESC")->select('client.client_id')->first();
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
}
