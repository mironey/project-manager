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
        $deliveredFiles = [
            fake()->imageUrl(),
            fake()->imageUrl(),
        ];

        return [
            'task_id' => Task::all()->random()->id,
            'name' => fake()->unique()->sentence(3),
            'description' => fake()->text(),
            'due_date' => Carbon::now()->addDays(1),
            'priority' => rand(1, 3),
            'status' => rand(1, 4),
            'user_id' => User::role('member')->pluck('id')->random(),
            'helping_kits' => serialize($deliveredFiles),
            'member_comment' => fake()->text(200),
            'delivered_files' => serialize($deliveredFiles)
        ];
    }
}
