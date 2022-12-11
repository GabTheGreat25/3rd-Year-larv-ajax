<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\investor;
use App\Models\User;
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
    {    
        $investor = investor::join('users','investor.user_id','users.id')->select('investor.*','users.email')->orderBy('investor.investor_id','DESC')->withTrashed()->get();
        return response()->json($investor);
    }

    public function getInvestorAll()
    {   
        return view('investor.index');
    }

    public function getRegisterInvestor(){
        return view('investor.register');
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
        $user->role = 'investor';
        $user->save();
        $lastInsertId = DB::getPdo()->lastInsertId();

        $investor = new investor;
        $investor->users()->associate($lastInsertId);
        $investor->full_name = $request->full_name;
        $investor->contact_number = $request->contact_number;
        $investor->age = $request->age;

        $files = $request->file('uploads');
        $investor->image_path = 'images/'.$files->getClientOriginalName();
        $investor->save();
        Storage::put('/public/images/'.$files->getClientOriginalName(),file_get_contents($files));
        return response()->json(["success" => "Investor Created Successfully.", "investor" => $investor, "status" => 200]);
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
    {   
        $investor = investor::find($id);
        $investor->full_name = $request->full_name;
        $investor->contact_number = $request->contact_number;
        $investor->age = $request->age;

        $files = $request->file('uploads');
        $investor->image_path = 'images/'.$files->getClientOriginalName();
        $investor->update();
        Storage::put('/public/images/'.$files->getClientOriginalName(),file_get_contents($files));
        return response()->json(["success" => "Investor Updated Successfully.", "investor" => $investor, "status" => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $investor = investor::with('users')->find($id);
        $investor->users()->delete();
        $investor = investor::findOrFail($id);
        $investor->delete();

        $data = array('success' => 'deleted', 'code' => '200');
        return response()->json($data);
    }

    public function restore($id)
    {
        $investor = investor::onlyTrashed()->find($id);
        $investor->restore();

        $investorr = investor::with('users')->find($id);
        $investorr->users()->restore();

        $data = array('success' => 'restored', 'code' => '200');
        return response()->json($data);
    }
}
