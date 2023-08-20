<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TodoResource::collection(Todo::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateData=Validator::make($request->all(),[
                'description'=>'required',
            ]);
            if($validateData->fails())
            {
                return response()->json([
                     'status'=>false,
                     'message'=>'Validation Errors',
                     'errors'=>$validateData->errors()
  
                ],422);
            }
            $todo = Todo::create([
                'description'=>$request->description
            ]);
  
            return response()->json([
                'status' => true,
                'message' => 'Task Created Successfully',
                'todo'=>$todo,
               
            ], 200);
  
        }catch (\Exception $ex)
        {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $todo=Todo::findOrFail($id);
        return new TodoResource($todo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       
        $validateData=Validator::make($request->all(),[
            'status'=>'required',
            
        ]);
        if($validateData->fails())
        {
            return response()->json([
                 'status'=>false,
                 'message'=>'Validation Errors',
                 'errors'=>$validateData->errors()

            ],422);
        }
        $todo=Todo::find($id);
        $todo->update([
            'status'=>$request->status,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Task Updated Successfully',
           ],201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $todo=Todo::find($id);
       $todo->delete();
       return response()->json([
        'status' => true,
        'message' => 'Task Deleted Successfully',
       ],201);
    }
}
