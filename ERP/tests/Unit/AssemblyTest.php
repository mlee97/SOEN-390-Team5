<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AssemblyTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_user_only_accessible_to_assembly()
    {
        //Create Manufacturer worker User
        $user = User::factory()->create();
        $user->user_type = 5;
        $response = $this->actingAs($user)->get('/assembly');

        $response->assertStatus(200);

        //Any User except Manufacturer worker user
        $user2 = User::factory()->create();
        do{
            $user_type = rand(0,10);
        } while(in_array($user_type, array(5)));
        $user2->user_type = $user_type;
        $response2 = $this->actingAs($user2)->get('/assembly');

        $response2->assertStatus(302); //Should redirect

    }
}