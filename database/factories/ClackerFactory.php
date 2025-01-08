<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use app\Models\Clacker;
use app\Models\User;
use Illuminate\Support\Str;
//use Illuminate\Support\Facades\Notification;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clacker>
 */
class ClackerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    //protected $model = Clacker::class;



    public function definition(): array
    {
        return [
            //'user_id' => User::factory(),
            'message' => Str::random(10),
           // 'created' => Notification::fake();
        ];
    }
}
