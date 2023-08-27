<?php

namespace App\Http\Requests\Course;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'duration' => 'required|integer',
            'teacher_id' => 'required|integer|exists:teachers,id',
            'classroom_id' => 'required|integer|exists:classrooms,id'
        ];
    }

    /**
     * Update the course using the validated data.
     */
    public function updateCourse(): Course
    {
        $course = Course::findOrFail($this->route('id'));

        $course->update([
            'name' => $this->name,
            'duration' => $this->duration,
            'teacher_id' => $this->teacher_id,
            'classroom_id' => $this->classroom_id
        ]);

        return $this->course;
    }
}
