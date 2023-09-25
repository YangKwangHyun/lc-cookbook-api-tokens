<?php

namespace Database\Factories;

use App\Models\Repo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class RepoFactory extends Factory
{
    protected $model = Repo::class;

    public function definition(): array
    {
        return [
            'user_id'     => $this->faker->numberBetween(1, 10),
            'name'        => $this->faker->name(),
            'description' => $this->faker->text(),
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ];
    }
}
