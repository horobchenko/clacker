<?php
 
namespace Tests\Feature\HttpTests;
 
use Tests\TestCase;
 
class DebuggingResponseTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function debugging_test(): void
    {
        $response = $this->get('/');
 
        $response->dumpHeaders();
 
        $response->dumpSession();
 
        $response->dump();
    }
}