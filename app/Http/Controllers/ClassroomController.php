<?php

namespace App\Http\Controllers;

use App\Http\Requests\Classroom\CreateClassroomRequest;
use App\Http\Requests\Classroom\UpdateClassroomRequest;
use App\Http\Resources\ClassroomResource;
use App\Models\Classroom;

class ClassroomController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth:sanctum', 'admin'])->except(['index', 'show']);
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = Classroom::all();

        return ClassroomResource::collection($classrooms);
    }

    /**
     * Create a newly created resource in storage.
     */
    public function create(CreateClassroomRequest $request)
    {
        $classroom = $request->createClassroom();

        return new ClassroomResource($classroom);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $classroom = Classroom::with('building')->find($id);

        return new ClassroomResource($classroom);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassroomRequest $request)
    {
        $classroom = $request->updateClassroom();

        return new ClassroomResource($classroom);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        //
    }
}
