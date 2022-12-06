<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\investor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class investorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   //basic get all 
        $investor = investor::orderBy('investor_id', 'DESC')->get();
        return response()->json($investor);
    }

    public function getInvestor()
    {   //get the view in resource
        return view('investor.index');
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
        $investor = new investor;
        $investor->name = $request->name;
        $investor->contact_number = $request->contact_number;
        $investor->age = $request->age;
        $investor->email = $request->email;
        $investor->password = Hash::make($request->input("password"));

        $files = $request->file('uploads');
        $investor->image_path = 'images/'.$files->getClientOriginalName();
        $investor->save();
        Storage::put('/public/images/'.$files->getClientOriginalName(),file_get_contents($files));
        return response()->json(["success" => "investor Created Successfully.", "investor" => $investor, "status" => 200]);
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
        $investor = investor::find($id);
        return response()->json($investor);
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
        $investor = investor::find($id);
        $investor->name = $request->name;
        $investor->contact_number = $request->contact_number;
        $investor->age = $request->age;
        $investor->email = $request->email;
        $investor->password = $request->password;

        $files = $request->file('uploads');
        $investor->image_path = 'images/'.$files->getClientOriginalName();
        $investor->update();
        Storage::put('/public/images/'.$files->getClientOriginalName(),file_get_contents($files));
        return response()->json(["success" => "investor Updated Successfully.", "investor" => $investor, "status" => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   //delete with image
        $investor = investor::findOrFail($id);

        if (File::exists("storage/" . $investor->image_path)) {
            File::delete("storage/" . $investor->image_path);
        }

        $investor->delete();

        $data = array('success' => 'deleted', 'code' => '200');
        return response()->json($data);
    }
}
