<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\operator;
use App\Models\comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class commentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operators = operator::all();
        return View::make('comment.index',compact('operators'));
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
        $operator = operator::find($id);
        $operatorr = DB::table('operator')
        ->rightJoin('comment','comment.operator_id','operator.operator_id')
        ->select('comment.comment_id', 'comment.username','comment.contact_number','comment.comments', 'comment.ratings', 'comment.operator_id', 'operator.image_path')
        ->where('comment.operator_id', $id)
        ->orderBy('comment.operator_id','DESC')
        ->get();
   
        return View::make('comment.show',compact('operator','operatorr'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            $request->validate([
                'username'=>'required',
                'contact_number'=>'required',
                'comments'=>'required|profanity',
                'ratings'=>'required|min:1|max:5',
            ]);

            $comments = new comment;
            $comments->operator_id = $id;
            $comments->username = $request->username;
            $comments->contact_number = $request->contact_number;
            $comments->comments = $request->comments;
            $comments->ratings = $request->ratings;
            $comments->save();
            return response()->json(["success" => "Comment Created Successfully.", "comment" => $comments, "status" => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
