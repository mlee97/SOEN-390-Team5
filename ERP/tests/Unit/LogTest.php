<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogTest extends TestCase
{
    use RefreshDatabase;

    public function test_log_management_page_only_accessible_to_IT()
    {
        //Create IT User (since only they can create users)
        $user = User::factory()->create();
        $user->user_type = 0;
        $response = $this->actingAs($user)->get('/logging');


        $response->assertStatus(200);


        //Any User except IT
        $user2 = User::factory()->create();
        $user2->user_type = rand(1,10);
        $response2 = $this->actingAs($user2)->get('/logging');

        $response2->assertStatus(302); //Should redirect
    }

    public function test_export_file_works_for_IT_only()
    {
        //Create IT User (since only they can create users)
        $user = User::factory()->create();
        $user->user_type = 0;

        $response = $this->actingAs($user)->get('/logging-CSV-export');
        $response->assertStatus(200);

        $response = $this->actingAs($user)->get('/logging-PDF-export');
        $response->assertStatus(200);


        //Any User except IT
        $user2 = User::factory()->create();
        $user2->user_type = rand(1,10);

        $response2 = $this->actingAs($user2)->get('/logging-CSV-export');
        $response2->assertStatus(302); //Should redirect

        $response2 = $this->actingAs($user2)->get('/logging-PDF-export');
        $response2->assertStatus(302); //Should redirect

    }
}
