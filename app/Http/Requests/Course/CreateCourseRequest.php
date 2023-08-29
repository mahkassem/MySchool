<?php

namespace App\Http\Requests\Course;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;

class CreateCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50',
            'duration' => 'required|string|max:50',
            'teacher_id' => 'required|integer|exists:teachers,id',
            'classroom_id' => 'required|integer|exists:classrooms,id'
        ];
    }

    /**
     * Create a new course using the validated data.
     */
    public function createCourse(): Course
    {
        $course = Course::create([
            'name' => $this->name,
            'duration' => $this->duration,
            'teacher_id' => $this->teacher_id,
            'classroom_id' => $this->classroom_id
        ]);

        return $course;
    }
}
