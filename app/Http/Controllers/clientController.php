<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\client;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Events\SendClient;
use Event;

class clientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = client::join('users','client.user_id','users.id')->select('client.*','users.email')->orderBy('client.client_id','DESC')->withTrashed()->get();
        return response()->json($client);
    }
    
    public function getClientAll()
    {
        return view('client.index');
    }

    public function getRegisterClient(){
        return view('client.register');
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
        $user = new User();
        $user->name = $request->full_name;
        $user->email = $request->email;
        $user->password = Hash::make($request['password']);
        $user->role = 'client';
        $user->save();
        $lastInsertId = DB::getPdo()->lastInsertId();

        $client = new client();
        $client->users()->associate($lastInsertId);
        $client->full_name = $request->full_name;
        $client->age = $request->age;
        $client->valid_id = $request->valid_id;
        $client->billing_address = $request->billing_address;
        $client->address = $request->address;
        $client->contact_number = $request->contact_number;
       
        $files = $request->file('uploads');
        $client->image_path = 'images/'.$files->getClientOriginalName();
        $client->save();
        Storage::put('/public/images/'.$files->getClientOriginalName(),file_get_contents($files));
        Event::dispatch(new SendClient($client));

       return response()->json(["success" => "Client Created Successfully.", "client" => $client, "status" => 200]);
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
        $client = client::find($id);
        return response()->json($client);
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
        $client = client::find($id);
        $client->full_name = $request->full_name;
        $client->age = $request->age;
        $client->valid_id = $request->valid_id;
        $client->billing_address = $request->billing_address;
        $client->address = $request->address;
        $client->contact_number = $request->contact_number;

        $files = $request->file('uploads');
        $client->image_path = 'images/'.$files->getClientOriginalName();
        $client->update();
        Storage::put('/public/images/'.$files->getClientOriginalName(),file_get_contents($files));
        return response()->json(["success" => "Client Updated Successfully.", "client" => $client, "status" => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  public function destroy($id)
    {
        $client = client::with('users')->find($id);
        $client->users()->delete();
        $client = client::findOrFail($id);
        $client->delete();

        $data = array('success' => 'deleted', 'code' => '200');
        return response()->json($data);
    }

    public function restore($id)
    {
        $client = client::onlyTrashed()->find($id);
        $client->restore();

        $clientt = client::with('users')->find($id);
        $clientt->users()->restore();

        $data = array('success' => 'restored', 'code' => '200');
        return response()->json($data);
    }
}
