<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(){
        try{
            $tasks = Task::all();
            if(count($tasks) == 0) {
                return response()->json();
            }
            return response()->json([
                'tasks' => $tasks,          
            ], 200);

        }catch (\Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }

    public function show($id){
        try{
            $tasks = Task::find($id);

            return response()->json([
                'task' => $task
            ],200);

        }catch (\Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }

    public function create(Request $request){
        try{
            $request->validate([
            'name'=>'required|string',
            'status'=>'required|integer',
            'description'=>'required|string',
            'user_id'=>'required|integer',     
            ]);

            $tasks = Task::create([
            'name'=>$request->name,
            'status'=>$request->status,
            'description'=>$request->description,
            'user_id'=>$request->user_id,
            ]);

            return response()->json([
                'message'=>'Carlos es el mejor profe del mundo '
            ]);
        }catch ( \Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }

    public function update($id, Request $request){
        try{
            $task = Task::find($id);

            if(!$task){
                return response()->json([
                    'error'=>'Task not found'
                ],404);
            }

            $task->update($request->all());

            return response()->json([
                'message' => 'Task update succesfully',
            ],200);
        }catch ( \Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }
    
    public function destroy($id){
        try{
            $task = Task::find($id);
            if(!$task){
                return response()->json([
                    'error' =>'Task not found',
                ],404);    
            }

            Task::destroy($id);

            return response()->json([
                'message' => 'Task deleted succesfully',
            ],200);
        } catch ( \Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }
}
