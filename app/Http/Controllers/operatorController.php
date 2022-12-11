<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\operator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;

class operatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operator = operator::join('users','operator.user_id','users.id')->select('operator.*','users.email')->orderBy('operator.operator_id','DESC')->withTrashed()->get();
        return response()->json($operator);
    }

    public function getOperatorAll()
    {
        return view('operator.index');
    }

    public function getRegisterOperator(){
        return view('operator.register');
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
        $user->role = 'operator';
        $user->save();
        $lastInsertId = DB::getPdo()->lastInsertId();

        $operator = new operator;
        $operator->users()->associate($lastInsertId);
        $operator->full_name = $request->full_name;
        $operator->contact_number = $request->contact_number;
        $operator->age = $request->age;
        $operator->address = $request->address;

        $files = $request->file('uploads');
        $operator->image_path = 'images/'.$files->getClientOriginalName();
        $operator->save();
        Storage::put('/public/images/'.$files->getClientOriginalName(),file_get_contents($files));
        return response()->json(["success" => "Operator Created Successfully.", "operator" => $operator, "status" => 200]);
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
        $operator = operator::find($id);
        return response()->json($operator);
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
        $operator = operator::find($id);
        $operator->full_name = $request->full_name;
        $operator->contact_number = $request->contact_number;
        $operator->age = $request->age;
        $operator->address = $request->address;

        $files = $request->file('uploads');
        $operator->image_path = 'images/'.$files->getClientOriginalName();
        $operator->update();
        Storage::put('/public/images/'.$files->getClientOriginalName(),file_get_contents($files));
        return response()->json(["success" => "Operator Updated Successfully.", "operator" => $operator, "status" => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $operator = operator::with('operators')->find($id);
        $operator->operators()->delete();
        $operator = operator::findOrFail($id);
        $operator->delete();

        $data = array('success' => 'deleted', 'code' => '200');
        return response()->json($data);
    }

    public function restore($id)
    {
      $operator = operator::onlyTrashed()->find($id);
      $operator->restore();

      $operatorr = operator::with('operators')->find($id);
      $operatorr->operators()->restore();

      $data = array('success' => 'restored', 'code' => '200');
      return response()->json($data);
    }
}
