<?php

namespace Tests\Feature\HttpTests;

use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;
use RefreshDatabase;


class ClackerComponentTest extends TestCase
{
    public function test_can_view_clacker()
    {
    	$this->withoutVite();
        $this->withoutMiddleware();
        $this->get('/clacker')
            ->assertInertia(fn (Assert $page) => $page->component('Clacker/Index')
            	->has('clackers')
               );
    }
}