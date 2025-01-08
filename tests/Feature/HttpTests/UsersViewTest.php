<?php

namespace Tests\Feature\HttpTests;

use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;
use RefreshDatabase;


class UsersViewTest extends TestCase
{
    public function test_success_response(): void
    {
        $view = $this->view('users');
        
        $view->assertSuccessful();
    }
    public function test_can_view_admin_contact(): void
    {
    	$view = $this->view('users');
 
        $view->assertSee('gorobchenkotatyana16@gmail.com');
    }

    public function test_can_show_users():void
    {
    	$view = $this->blade('<x-show-users/>');
 
        $view->assertSee('User');
    }
    
}