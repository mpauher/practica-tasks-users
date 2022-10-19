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
            $task = Task::find($id);

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
            ]);

            $tasks = Task::create([
            'name'=>$request->name,
            'status'=>$request->status,
            'description'=>$request->description,
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

    public function assignTask(Request $request){
        try{
            $request->validate([
               'user_id'=>'required|integer',
               'task_id'=>'required|integer'
            ]);

            $task_id = $request->task_id;


            $task = Task::find($task_id);

            if(!$task){
                return response()->json([
                    'error'=>'Task not found'
                ],404);
            }

            $task->user_id = $request->user_id;
            $task->save();

            return response()->json([
                'message' => 'Task assign succesfully',
            ],200);
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

    public function indexByUser(){
        try{
            $id=auth()->user()->id;
            $tasks = Task::where('user_id', $id)->get();

            // if(count($tasks) == 0) {
            //     return response()->json();
            // }

            return response()->json([
                'tasks' => $tasks,          
            ], 200);

        }catch (\Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }
}
