<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\service;
use App\Models\operator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;

class serviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
       $service = service::join('operator','services.operator_id','operator.operator_id')->select('services.*','operator.full_name')->orderBy('services.services_id','DESC')->get();
        return response()->json($service);
    }

    public function getServiceAll()
    {
        return view('service.index');
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
        $service = new service;

        $service->service_type = $request->service_type;
        $service->date_of_service = $request->date_of_service;
        $service->price = $request->price;
        $service->operator_id = $request->operator_id;

        $files = $request->file('uploads');
        $service->image_path = 'images/'.$files->getClientOriginalName();
        $service->update();
        Storage::put('/public/images/'.$files->getClientOriginalName(),file_get_contents($files));
        return response()->json(["success" => "Service Created Successfully.", "service" => $service, "status" => 200]);
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
        $service = service::find($id);
        return response()->json($service);
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
        $service = service::find($id);
        $service->service_type = $request->service_type;
        $service->date_of_service = $request->date_of_service;
        $service->price = $request->price;
        $service->operator_id = $request->operator_id;

        $files = $request->file('uploads');
        $service->image_path = 'images/'.$files->getClientOriginalName();
        $service->update();
        Storage::put('/public/images/'.$files->getClientOriginalName(),file_get_contents($files));
        return response()->json(["success" => "Service Updated Successfully.", "service" => $service, "status" => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = service::findOrFail($id);

        if (File::exists("storage/" . $service->image_path)) {
            File::delete("storage/" . $service->image_path);
        }

        $service->delete();

        $data = array('success' => 'deleted', 'code' => '200');
        return response()->json($data);
    }
}   
