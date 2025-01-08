<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Login extends Page
{
    /**
     * Get the URL for the page.
     */
    public function url(): string
    {
        return '/login';
    }

    /**
     * Assert that the browser is on the page.
     */
    public function assert(Browser $browser): void
    {
       $browser->assertPathIs($this->url());
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array<string, string>
     */
    public function elements(): array
    {
        return [
            '@login' => '#app > div > div.mt-6.w-full.overflow-hidden.bg-white.px-6.py-4.shadow-md.sm\:max-w-md.sm\:rounded-lg > form > div.mt-4.flex.items-center.justify-end > button',
        ];
    }
    
    
    public function login(Browser $browser): void 
    {
        $user = DB::table('users')
                ->where('email', 'taylor@laravel.com')
                ->get();
                
        $browser->visit('http://clacker.test/login')
                ->type('#email', $user->email)
                ->type('#password', $user->password)
                ->press('#app > div > div.mt-6.w-full.overflow-hidden.bg-white.px-6.py-4.shadow-md.sm\:max-w-md.sm\:rounded-lg > form > div.mt-4.flex.items-center.justify-end > button');
                    
    }
    
    
}
