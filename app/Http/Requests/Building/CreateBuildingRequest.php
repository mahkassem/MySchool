<?php

namespace App\Http\Requests\Building;

use App\Models\Building;
use Illuminate\Foundation\Http\FormRequest;

class CreateBuildingRequest extends FormRequest
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
            'name' => 'required|string|max:50|unique:buildings',
        ];
    }

    /**
     * Create building.
     */
    public function createBuilding(): Building
    {
        return Building::create([
            'name' => $this->name,
        ]);
    }
}
