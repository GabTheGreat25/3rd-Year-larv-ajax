<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\accessories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use App\Traits\ResponseTrait;

class accessoriesController extends Controller
{
    use ResponseTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $accessories = accessories::orderBy('accessories_id', 'DESC')->get();
        return response()->json($accessories);
    }

    public function getAccessoriesAll()
    {   
        return view('accessories.index');
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
        $accessories = new accessories;
        $accessories->description = $request->description;
        $accessories->quantity = $request->quantity;
        $accessories->costs = $request->costs;

        $files = $request->file('uploads');
        $accessories->image_path = 'images/'.$files->getClientOriginalName();
        $accessories->save();
        Storage::put('/public/images/'.$files->getClientOriginalName(),file_get_contents($files));
        return response()->json(["success" => "accessories Created Successfully.", "accessories" => $accessories, "status" => 200]);
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
        $accessories = accessories::find($id);
        return response()->json($accessories);
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
        $accessories = accessories::find($id);
        $accessories->description = $request->description;
        $accessories->quantity = $request->quantity;
        $accessories->costs = $request->costs;

        $files = $request->file('uploads');
        $accessories->image_path = 'images/'.$files->getClientOriginalName();
        $accessories->update();
        Storage::put('/public/images/'.$files->getClientOriginalName(),file_get_contents($files));
        return response()->json(["success" => "accessories Updated Successfully.", "accessories" => $accessories, "status" => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {  
        $accessories = accessories::findOrFail($id);

        if (File::exists("storage/" . $accessories->image_path)) {
            File::delete("storage/" . $accessories->image_path);
        }

        $accessories->delete();

        $data = array('success' => 'deleted', 'code' => '200');
        return response()->json($data);
    }
}
