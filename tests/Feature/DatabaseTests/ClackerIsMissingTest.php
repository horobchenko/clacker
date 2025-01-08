<?php

namespace Tests\Feature\DatabaseTests;

use app\Models\Clacker;
use app\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClackerIsMissingTest extends TestCase
{
    /**
     * A basic test example.
     */
    use RefreshDatabase;

    public function test_clacker_model_can_be_missing(): void
    
   {  
      $user = User::factory()->create();

   	  $clacker = Clacker::factory()->for($user)->create();
 
      $clacker->delete();

      $this->assertModelMissing($clacker);
   }
    
}