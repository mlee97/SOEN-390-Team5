<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountantTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Checks if sales page can be rendered.
     */
    public function test_sales_page_can_be_rendered()
    {
        $user = User::factory()->create();
        $user->user_type = 0;
        $response = $this->actingAs($user)->get('/accountant');

        $response->assertStatus(200); // If sales page is rendered, the status will be 200.
    }
}
