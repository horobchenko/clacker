<?php

namespace Tests\Browser;

//use Illuminate\Foundation\Testing\DatabaseMigrations;
//use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use App\Models\User;
use Tests\DuskTestCase;
use Illuminate\Support\Facades\DB;
use Tests\Browser\Pages\Login;

class LoginPageMethodTest extends DuskTestCase
{

    //use DatabaseTruncation;
    /**
     * A Dusk test example.
     */
    public function test_login_by_page_method(): void
    {
        $user = User::find(1);
 
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit(new Login)
                    ->type('@e', $user->email)
                    ->type('@pass', $user->password)
                    ->press('@login');
                    
        });
    }


}
