<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assignment>
 */
class AssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'task_id' => Task::all()->random()->id,
            'name' => fake()->unique()->sentence(3),
            'description' => fake()->text(),
            'due_date' => Carbon::now()->addDays(1),
            'priority' => rand(1, 3),
            'status' => rand(1, 3),
            'user_id' => User::role('member')->pluck('id')->random(),
            'member_comment' => fake()->text(200),
            'complete_assignment' => fake()->imageUrl
        ];
    }
}
