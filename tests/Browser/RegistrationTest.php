<?php

namespace Tests\Browser;

//use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Laravel\Dusk\Browser;
use App\Models\User;
use Tests\DuskTestCase;

class RegistrationTest extends DuskTestCase
{
     use DatabaseTruncation;
     use WithoutMiddleware;
    /**
     * A Dusk test example.
     */
    public function test_registration(): void
    {
        $user = User::factory()->create([
            'email' => 'taylor@laravel.com',
        ]);
 
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/register')
                    ->screenshot('registrationTest')
                    ->type('#name', $user->name)
                    ->type('#email', $user->email)
                    ->type('#password', $user->password)
                    ->type('#password_confirmation', $user->password)
                    ->press('#app > div > div.mt-6.w-full.overflow-hidden.bg-white.px-6.py-4.shadow-md.sm\:max-w-md.sm\:rounded-lg > form > div.mt-4.flex.items-center.justify-end > button');
                    
                   
        });
    }
}