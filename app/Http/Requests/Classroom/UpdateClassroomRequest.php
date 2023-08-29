<?php

namespace App\Http\Requests\Classroom;

use App\Models\Classroom;
use Illuminate\Foundation\Http\FormRequest;

class UpdateClassroomRequest extends FormRequest
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
            'id' => 'required|exists:classrooms',
            'name' => 'required|string|max:50|unique:classrooms,name,' . $this->id,
            'building_id' => 'required|exists:buildings,id',
        ];
    }

    /**
     * Update classroom.
     */
    public function updateClassroom(): Classroom
    {
        $classroom = Classroom::find($this->id);

        $classroom->update([
            'name' => $this->name,
            'building_id' => $this->building_id,
        ]);

        return $classroom;
    }
}
