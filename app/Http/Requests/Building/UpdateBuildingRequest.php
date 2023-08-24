<?php

namespace App\Http\Requests\Building;

use App\Models\Building;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBuildingRequest extends FormRequest
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
            'id' => 'required|integer|exists:buildings,id',
            'name' => 'required|string|max:50|unique:buildings,name,' . $this->id,
        ];
    }

    /**
     * Update building.
     */
    public function updateBuilding(): Building
    {
        $building = Building::find($this->id);
        $building->update([
            'name' => $this->name,
        ]);

        return $building;
    }
}
