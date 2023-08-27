<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $majors = [
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
            'major' => fake()->randomElement($majors),
        ];
    }

    /**
     * Indicate that the student custom major.
     */
    public function major(string $major): static
    {
        return $this->state(fn (array $attributes) => [
            'major' => $major,
        ]);
    }
}
