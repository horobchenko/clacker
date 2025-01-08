<?php

namespace Tests\Browser;

//use Illuminate\Foundation\Testing\DatabaseMigrations;
//use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use App\Models\User;
use Tests\DuskTestCase;
use Tests\Browser\Pages\Login;


class SendClackerTest extends DuskTestCase
{
     //use DatabaseTruncation;
    /**
     * A Dusk test example.
     */
    public function test_send_clacker(): void
    {
           
           $this->browse(function (Browser $browser) {
           $browser ->visit(new Login)
                    ->login() 
                    ->visit('/clacker')
                    //->visit('http://clacker.test/dashboard')
                    //->click('#app > div > nav > div.mx-auto.max-w-7xl.px-4.sm\:px-6.lg\:px-8 > div > div:nth-child(1) > div.hidden.space-x-8.sm\:-my-px.sm\:ms-10.sm\:flex > a.inline-flex.items-center.border-b-2.px-1.pt-1.text-sm.font-medium.leading-5.transition.duration-150.ease-in-out.focus\:outline-none.border-transparent.text-gray-500.hover\:border-gray-300.hover\:text-gray-700.focus\:border-gray-300.focus\:text-gray-700')
                    ->type('#app > div > main > div > form > textarea', 'Hello')
                    ->press('#app > div > main > div > form > button');
       });
    }
}