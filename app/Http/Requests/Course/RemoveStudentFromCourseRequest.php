<?php

namespace App\Http\Requests\Course;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;

class RemoveStudentFromCourseRequest extends FormRequest
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
            'student_id' => 'required|integer|exists:students,id',
            'course_id' => 'required|integer|exists:courses,id'
        ];
    }

    /**
     * Remove a student from a course using the validated data.
     */
    public function removeStudentFromCourse(): void
    {
        $course = Course::findOrFail($this->course_id);

        $course->students()->detach($this->student_id);

        // Alternative way to remove a student from a course
        // CourseStudent::where([
        //     'student_id' => $this->student_id,
        //     'course_id' => $this->course_id
        // ])->delete();
    }
}
