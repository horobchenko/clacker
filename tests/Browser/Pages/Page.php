<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Page as BasePage;

abstract class Page extends BasePage
{
    /**
     * Get the global element shortcuts for the site.
     *
     * @return array<string, string>
     */
    public static function siteElements(): array
    {
        return [
            '@e' => '#email',
            '@pass' => '#password',
            '@clacker_message' => '#app > div > main > div > form > textarea',
            '@clacker_send_button' => '#app > div > main > div > form > button',
            '@password_again'=> '#password_confirmation',
            '@register' => '#app > div > div.mt-6.w-full.overflow-hidden.bg-white.px-6.py-4.shadow-md.sm\:max-w-md.sm\:rounded-lg > form > div.mt-4.flex.items-center.justify-end > button',
        
        ];
    }
}
