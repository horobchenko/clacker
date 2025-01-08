<?php

namespace Tests\Browser\Components;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Component as BaseComponent;

class L_sign extends BaseComponent
{
    /**
     * Get the root selector for the component.
     */
    public function selector(): string
    {
        return '#app > div > nav';
    }

    /**
     * Assert that the browser page contains the component.
     */
    public function assert(Browser $browser): void
    {
        $browser->assertVisible($this->selector());
    }

    /**
     * Get the element shortcuts for the component.
     *
     * @return array<string, string>
     */
    public function elements(): array
    {
        return [
            '@L_sign' => '#app > div > nav > div.mx-auto.max-w-7xl.px-4.sm\:px-6.lg\:px-8 > div > div:nth-child(1) > div.flex.shrink-0.items-center > a',
        ];
    }

    /**
     * Clickin redirect to a home page.
     *
     * 
     */

    public function click_L_sign(Browser $browser): void
    {
        $browser->click('@L_sign')
                ->->assertPathIs('/');
    }
}
