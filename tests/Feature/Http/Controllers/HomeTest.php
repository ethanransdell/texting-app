<?php

namespace Tests\Feature\Http\Controllers;

use App\User;
use Tests\TestCase;

class HomeTest extends TestCase
{
    public function testUnauthenticated()
    {
        $response = $this->get('/');

        $response->assertRedirect(route('login'));
    }

    public function testAuthenticated()
    {
        $response = $this
            ->actingAs(factory(User::class)->create())
            ->get('/');

        $response
            ->assertSuccessful()
            ->assertViewIs('home');
    }
}
