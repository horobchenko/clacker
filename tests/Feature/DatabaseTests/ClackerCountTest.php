<?php

namespace Tests\Feature;
use app\Models\Clacker;
use app\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClackerCountTest extends TestCase
{
    /**
     * A basic test example.
     */
    use RefreshDatabase;

    public function test_clacker_model_count(): void
    {
    	$user = User::factory()->create();

        $clackers = Clacker::factory()->for($user)->count(3)->create();

        $this->assertDatabaseCount('clackers', 3);


     }
}