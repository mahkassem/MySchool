<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\AddStudentToCourseRequest;
use App\Http\Requests\Course\CreateCourseRequest;
use App\Http\Requests\Course\RemoveStudentFromCourseRequest;
use App\Http\Requests\Course\UpdateCourseRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Cache;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'admin'])->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $key = 'courses_' . request()->fullUrl();
        $duration = 600; // 10 minutes

        $data = Cache::remember($key, $duration, function () {
            $courses = Course::query();

            // add relationships
            $courses = $courses->with(['teacher', 'classroom', 'teacher.user']);

            // search by name
            if (request()->has('search') && !empty(request()->search)) {
                $courses->where('name', 'like', '%' . request()->search . '%');
            }

            // filter by duration
            if (request()->has('duration') && !empty(request()->duration)) {
                $courses->where('duration', 'like', '%' . request()->duration . '%');
            }

            // filter by teacher
            // TODO: implement fulltext search in course model
            if (request()->has('teacher') && !empty(request()->teacher)) {
                $courses->searchByTeacherName(request()->teacher);
            }

            $courses = $courses->simplePaginate(
                request()->per_page ?? 10
            );

            return CourseResource::collection($courses);
        });

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateCourseRequest $request)
    {
        $course = $request->createCourse();

        return new CourseResource($course);
    }

    /**
     * Add student to course
     */
    public function addStudent(AddStudentToCourseRequest $request)
    {
        $request->addStudentToCourse();

        return response()->json([
            'message' => 'Student added to course successfully',
            'data' => null,
        ], 201);
    }

    /**
     * Remove student from course
     */
    public function removeStudent(RemoveStudentFromCourseRequest $request)
    {
        $request->removeStudentFromCourse();

        return response()->json([
            'message' => 'Student removed from course successfully',
            'data' => null,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::with([
            'teacher',
            'classroom',
            'teacher.user',
            'students',
            'students.user',
        ])->findOrFail($id);

        return new CourseResource($course);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request)
    {
        $course = $request->updateCourse();

        return new CourseResource($course);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $course = Course::findOrFail($id);

        $course->delete();

        return response()->json([
            'message' => 'Course deleted successfully',
            'data' => null,
        ], 200);
    }
}
