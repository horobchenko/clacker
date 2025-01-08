<?php

namespace Tests\Feature;
use app\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MailExistsTest extends TestCase
{
    /**
     * A basic test example.
     */
    use RefreshDatabase;

    public function test_user_mail_exists(): void
    
    { $this->assertDatabaseMissing('users', [
    'email' => 'gorobchenkotatyana16@gmail.com',
]);}

}