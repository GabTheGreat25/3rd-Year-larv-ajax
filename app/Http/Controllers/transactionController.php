<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\camera;
use App\Models\accessories;
use App\Models\transaction;
use App\Models\client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class transactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $transaction = transaction::join('client','transaction.client_id','client.client_id')->select('transaction.*','client.full_name','client.image_path')->orderBy('transaction.transaction_id','DESC')->get();
        return response()->json($transaction);
    }

    public function getTransactionAll()
    {   
        return view('transaction.index');
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
        //
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
        $transaction = transaction::find($id);
        return response()->json($transaction);
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
        $transaction = transaction::find($id);
        $transaction->status = $request->status;
        $transaction->update();

        return response()->json(["success" => "Transaction Updated Successfully.", "transaction" => $transaction, "status" => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {  
        $transaction = transaction::findOrFail($id);
        $transaction->delete();

        $data = array('success' => 'deleted', 'code' => '200');
        return response()->json($data);
    }
}
