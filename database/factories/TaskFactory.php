<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
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
            'project_id' => Project::all()->random()->id,
            'name' => fake()->unique()->sentence(3),
            'description' => fake()->text(),
            'due_date' => Carbon::now()->addDays(3),
            'priority' => rand(1, 3),
            'status' => rand(1, 4),
            'user_id' => User::role('supervisor')->pluck('id')->random(),
            'helping_kits' => serialize($deliveredFiles),
            'related_comment' => fake()->text(200),
            'delivered_files' => serialize($deliveredFiles)
        ];
    }
}
