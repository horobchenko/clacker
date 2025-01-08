<?php

namespace Tests\Feature;
use app\Models\Clacker;
use app\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClackerInstanceTest extends TestCase
{
    /**
     * A basic test example.
     */
    use RefreshDatabase;

    public function test_clacker_model_can_be_created(): void
    {
        $user = User::factory()->create();

        $clacker = Clacker::factory()->for($user)->create();

        $this->assertModelExists($clacker);
    }
}