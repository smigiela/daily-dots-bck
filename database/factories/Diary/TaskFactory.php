<?php

namespace Database\Factories\Diary;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AppModelsDiaryTask>
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
        $users = User::all()->pluck('id')->toArray();

        return [
            'id' => $this->faker->unique()->uuid(),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->sentence(20),
            'user_id' => $this->faker->randomElement($users),
            'status' => $this->faker->randomElement(['new', 'in_progress', 'complete']),
            'type' => $this->faker->randomElement(['task', 'meeting', 'visit']),
            'status_change_date' => null,
            'due_date' => $this->faker->date('Y-m-d H:i:s'),
            'start_time' => $this->faker->randomElement([null, $this->faker->dateTime('Y-m-d H:i')]),
            'stop_time' => $this->faker->randomElement([null, $this->faker->dateTime('Y-m-d H:i')]),
        ];
    }

    protected function callAfterCreating(Collection $instances, ?Model $parent = null)
    {
        $instances->each(function ($model) {
            if ($model['status'] !== 'new') {
               $model['status_change_date'] = $this->faker->date();
               $model->save();
            }
        });
    }
}
