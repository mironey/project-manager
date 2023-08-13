<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start_date = now();
        $end_date = Carbon::parse($start_date)->addDays(5);
        return [
            'name' => fake()->unique()->sentence(3),
            'description' => fake()->text(),
            'start_date' => $start_date,
            'end_date' => $end_date,
            'status' => rand(1, 3),
            'user_id' => User::all()->random()->id
        ];
    }
}
