<?php

namespace Tests\Browser;

//use Illuminate\Foundation\Testing\DatabaseMigrations;
//use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use App\Models\User;
use Tests\DuskTestCase;
use Illuminate\Support\Facades\DB;

class LoginTest extends DuskTestCase
{
    //use DatabaseTruncation;
    /**
     * A Dusk test example.
     */
    public function test_login(): void
    {
        $user = User::find(1);
 
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                    ->type('#email', $user->email)
                    ->type('#password', $user->password)
                    ->press('#app > div > div.mt-6.w-full.overflow-hidden.bg-white.px-6.py-4.shadow-md.sm\:max-w-md.sm\:rounded-lg > form > div.mt-4.flex.items-center.justify-end > button');
                    
        });
    }
}
