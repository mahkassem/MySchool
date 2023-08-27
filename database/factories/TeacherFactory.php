<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subjects = [
            'Math',
            'Science',
            'English',
            'History',
            'Art',
            'Music',
            'Physical Education',
            'Computer Science',
            'Foreign Language'
        ];

        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'user_id' => User::factory()->create()->id,
            'subject' => fake()->randomElement($subjects),
        ];
    }

    /**
     * Indicate that the teacher custom subject.
     */
    public function subject(string $subject): static
    {
        return $this->state(fn (array $attributes) => [
            'subject' => $subject,
        ]);
    }
}
