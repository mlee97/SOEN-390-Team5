<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Machine;
use Illuminate\Support\Facades\DB;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManufacturingTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_user_only_accessible_to_manufacturing()
    {
        //Create manufacturing user
        $user1 = User::factory()->create();
        $user1->user_type = 5;
        $response = $this->actingAs($user1)->get('/machine-status');

        $response->assertStatus(200);

        //Create any except manufacturing user
        $user2 = User::factory()->create();
        do{
            $user_type = rand(0,10);
        } while(in_array($user_type, array(5)));
        $user2->user_type = $user_type;
        $response2 = $this->actingAs($user2)->get('/machine-status');

        $response2->assertStatus(302); //Should redirect
    }

    public function test_change_status_off_to_on()
    {
        //Create manufacturing user
        $user = User::factory()->create();
        $user->user_type = 5;

        //Create test machine
        DB::table('machines')->insert([
            'name' => 'Test',
            'status' => 'offline']);

        $machine_id = DB::table('machines')->where('status', 'offline')->value('id'); //Get ID
        $uri = '/change-status/'.$machine_id;

        $updatedMachine = Machine::find($machine_id);
        $this->actingAs($user)->get($uri);
        $this->assertDatabaseHas('machines', ['id' => $machine_id, 'status' => 'online']);

    }

    public function test_change_status_on_to_off()
    {
        //Create manufacturing user
        $user = User::factory()->create();
        $user->user_type = 5;

        //Create test machine
        DB::table('machines')->insert([
            'name' => 'Test',
            'status' => 'online']);

        $machine_id = DB::table('machines')->where('status', 'online')->value('id'); //Get ID
        $uri = '/change-status/'.$machine_id;

        $updatedMachine = Machine::find($machine_id);
        $this->actingAs($user)->get($uri);
        $this->assertDatabaseHas('machines', ['id' => $machine_id, 'status' => 'offline']);
    }
}