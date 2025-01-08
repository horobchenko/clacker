<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HelloTest extends DuskTestCase
{
    
    use WithoutMiddleware;
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {   
        
        $this->browse(function (Browser $browser) {
            $browser->visit('http://clacker.test')
                    ->assertSee('Welcome to Clacker!');
        });
    }
}
