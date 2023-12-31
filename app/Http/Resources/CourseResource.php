<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'duration' => $this->duration,
            'teacher' => new TeacherResource($this->whenLoaded('teacher')),
            'classroom' => new ClassroomResource($this->whenLoaded('classroom')),
            'students' => StudentResource::collection($this->whenLoaded('students')),
        ];
    }
}
