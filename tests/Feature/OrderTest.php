<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use APP\Models\User;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function setUp(): void{
        parent::setUp();
    }
    public function test_example(): void
    {
        User::create([

        ]);
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
