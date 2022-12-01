<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\camera;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;

class cameraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   //basic get all 
        $camera = camera::orderBy('camera_id', 'DESC')->get();
        return response()->json($camera);
    }

    public function getCamera()
    {   //get the view in resource
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
    {   //basic create with image save in public storage
        $camera = new camera;
        $camera->model = $request->model;
        $camera->shuttercount = $request->shuttercount;
        $camera->quantity = $request->quantity;
        $camera->costs = $request->costs;

        $files = $request->file('uploads');
        $camera->image_path = 'images/'.$files->getClientOriginalName();
        $camera->save();
        Storage::put('/public/images/'.$files->getClientOriginalName(),file_get_contents($files));
        return response()->json(["success" => "camera Created Successfully.", "camera" => $camera, "status" => 200]);
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
    {   //find existing data returning to json
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
    {   //copy paste store just change new as find to override it
        $camera = camera::find($id);
        $camera->description = $request->description;
        $camera->shuttercount = $request->shuttercount;
        $camera->quantity = $request->quantity;
        $camera->costs = $request->costs;

        $files = $request->file('uploads');
        $camera->image_path = 'images/'.$files->getClientOriginalName();
        $camera->save();
        Storage::put('/public/images/'.$files->getClientOriginalName(),file_get_contents($files));
        return response()->json(["success" => "camera Updated Successfully.", "camera" => $camera, "status" => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   //delete with image
        $camera = camera::findOrFail($id);

        if (File::exists("storage/" . $camera->image_path)) {
            File::delete("storage/" . $camera->image_path);
        }

        $camera->delete();

        $data = array('success' => 'deleted', 'code' => '200');
        return response()->json($data);
    }
}
