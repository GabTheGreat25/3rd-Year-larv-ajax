<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Events\SendAdmin;
use Event;

class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = admin::join('users','admin.user_id','users.id')->select('admin.*','users.email')->orderBy('admin.admin_id','DESC')->withTrashed()->get();
        return response()->json($admin);
    }
    
    public function getAdminAll()
    {
        return view('admin.index');
    }

    public function getRegisterAdmin(){
        return view('admin.register');
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->full_name;
        $user->email = $request->email;
        $user->password = Hash::make($request['password']);
        $user->role = 'admin';
        $user->save();
        $lastInsertId = DB::getPdo()->lastInsertId();

        $admin = new admin();
        $admin->users()->associate($lastInsertId);
        $admin->full_name = $request->full_name;
        $admin->age = $request->age;
       
        $files = $request->file('uploads');
        $admin->image_path = 'images/'.$files->getClientOriginalName();
        $admin->save();
        Storage::put('/public/images/'.$files->getClientOriginalName(),file_get_contents($files));
        Event::dispatch(new SendAdmin($admin));   

       return response()->json(["success" => "Admin Created Successfully.", "admin" => $admin, "status" => 200]);
    }

    public function edit($id)
    {
        $admin = admin::find($id);
        return response()->json($admin);
    }

    public function update(Request $request, $id)
    {
        $admin = admin::find($id);
        $admin->full_name = $request["full_name"];
        $admin->age = $request->age;

        // $files = $request->file('uploads');
        // $admin->image_path = 'images/'.$files->getClientOriginalName();
        $admin->update();
        // Storage::put('/public/images/'.$files->getClientOriginalName(),file_get_contents($files));
        return response()->json(["success" => "Admin Updated Successfully.", "admin" => $admin, "status" => 200]);
    }

    public function destroy($id)
    {
        $admin = admin::with('users')->find($id);
        $admin->users()->delete();
        $admin = admin::findOrFail($id);
        $admin->delete();

        $data = array('success' => 'deleted', 'code' => '200');
        return response()->json($data);
    }

    public function restore($id)
    {
        $admin = admin::onlyTrashed()->find($id);
        $admin->restore();

        $adminn =  admin::with('users')->find($id);
        $adminn->users()->restore();

        $data = array('success' => 'restored', 'code' => '200');
        return response()->json($data);
    }
}
