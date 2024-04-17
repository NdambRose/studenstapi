<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class tasksController extends Controller
{
    public function index()
    {
        $tasks = tasks::All();
        if($tasks-> count () >0){
            return response()->json([
                'status'=> 200,
                'tasks'=> $tasks
            ],200);
        }
        else{
            return response()->json([
                'status'=> 404,
                'status_message'=> 'No records available'
            ],404);
        }
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'title'=>'required|string|max:191'
        ]);

        if($validator-> fails()){
            return response()->json([
                'status'=> 422,
                'error'=> $validator->messages()
            ],422);
            
        }
        else{
            $tasks = tasks::create([
                'title'=>$request->title,
                'description'=>$request->description,
                'completed'=>$request->completed
            ]);
        }
        if($tasks){
            return response()->json([
                'status'=> 200,
                'message'=> "Task created succesfully"
            ],200);
        }
        else{
            return response()->json([
                'status'=> 500,
                'message'=> "something went wrong"
            ],500);
        }
    }

    public function show($id){
        $tasks=tasks::find($id);
        if($tasks){
            return response()->json([
                'status'=> 200,
                'tasks'=> $tasks
            ],200);
        }
        else{
            return response()->json([
                'status'=> 404,
                'message'=> 'No such task found'
            ],404);
        }
    }

    public function edit($id){
        $tasks=tasks::find($id);
        if($tasks){
            return response()->json([
                'status'=> 200,
                'tasks'=> $tasks
            ],200);
        }
        else{
            return response()->json([
                'status'=> 404,
                'message'=> 'No such task found'
            ],404);
        }
    }

    public function update(Request $request, int $id){
        $validator = Validator::make($request->all(),[
            'title'=>'required|string|max:191'
        ]);

        if($validator-> fails()){
            return response()->json([
                'status'=> 422,
                'error'=> $validator->messages()
            ],422);
            
        }
        else{
            $tasks = tasks::find($id);
            
        }
        if($tasks){

            $tasks->update([
                'title'=>$request->title,
                'description'=>$request->description,
                'completed'=>$request->completed
            ]);
            return response()->json([
                'status'=> 200,
                'message'=> "Task updated succesfully"
            ],200);
        }
        else{
            return response()->json([
                'status'=> 404,
                'message'=> "No such task found"
            ],404);
        }
    }
    public function destroy($id){
        $tasks = tasks::find($id);
        if($tasks){
            $tasks->delete();
            return response()->json([
                'status'=> 200,
                'message'=> "Task deleted succesfully"
            ],200);
        }
        else{
            return response()->json([
                'status'=> 404,
                'message'=> "No such task found"
            ],404);
        }
    }
}
