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
        $user->user_type = 6;
        $response = $this->actingAs($user)->get('/accountant');

        $response->assertStatus(200); // If sales page is rendered, the status will be 200.
    }

    public function test_only_authenticated_user_can_access_accountant_page()
    {
        //Create accountant user
        $user1 = User::factory()->create();
        $user1->user_type = 6;
        $response = $this->actingAs($user1)->get('/accountant');
    
        $response->assertStatus(200);
    
        //Create any except accountant user
        $user2 = User::factory()->create();
        do{
            $user_type = rand(0,10);
        } while(in_array($user_type, array(6)));
        $user2->user_type = $user_type;
        $response2 = $this->actingAs($user2)->get('/accountant');

        $response2->assertStatus(302); //Should redirect
    }
}
