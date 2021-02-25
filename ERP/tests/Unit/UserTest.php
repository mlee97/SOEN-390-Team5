<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_user_page_only_accessible_to_IT()
    {
        //Create IT User (since only they can create users)
        $user = User::factory()->create();
        $user->user_type = 0;
        $response = $this->actingAs($user)->get('/create-user');


        $response->assertStatus(200);


        //Any User except IT
        $user2 = User::factory()->create();
        $user2->user_type = rand(1,10);
        $response2 = $this->actingAs($user2)->get('/create-user');

        $response2->assertStatus(302); //Should redirect
    }

    public function test_only_IT_users_can_manage_users()
    {
        //Create IT User (since only they can create users)
        $user = User::factory()->create();
        $user->user_type = 0;

        $userToUpdate = User::factory()->create();
        $userToUpdate->email = "test123@example.com";
        $userToUpdate->save();

        $this->assertDatabaseHas('users',
            ['email' => 'test123@example.com']);

        $response = $this->actingAs($user)->post('/update-user', [
            'user_id'=> $userToUpdate->id,
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'updatedEmail@example.com',
            'user_type' => 2
        ]);

        $this->assertDatabaseMissing('users',
            ['email' => 'test123@example.com']);
        $this->assertDatabaseHas('users',
            ['email' => 'updatedEmail@example.com']);


        //Any User except IT
        $user2 = User::factory()->create();
        $user2->user_type = rand(1,10);

        $userToUpdate2 = User::factory()->create();
        $userToUpdate2->email = "test12345@example.com";
        $userToUpdate2->save();


        $response2 = $this->actingAs($user2)->post('/user-management',[
            'user_id'=> $userToUpdate2->id,
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'updatedEmail2@example.com',
            'user_type' => 2
        ]);
        $this->assertDatabaseHas('users',
            ['email' => 'test12345@example.com']);
        $this->assertDatabaseMissing('users',
            ['email' => 'updatedEmail2@example.com']);

    }

    public function test_manage_user_only_accessible_to_IT()
    {
        //Create IT User (since only they can create users)
        $user = User::factory()->create();
        $user->user_type = 0;
        $response = $this->actingAs($user)->get('/user-management');


        $response->assertStatus(200);


        //Any User except IT
        $user2 = User::factory()->create();
        $user2->user_type = rand(1,10);
        $response2 = $this->actingAs($user2)->get('/user-management');

        $response2->assertStatus(302); //Should redirect
    }

    public function test_only_IT_user_can_create_users()
    {

        //Create IT User (since only they can create users)
        $user = User::factory()->create();
        $user->user_type = 0;

        $this->actingAs($user)->post('/create-user', [
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'password' => 'password',
            'user_type' => rand(0, 3),
            'password_confirmation' => 'password',
        ]);

        $this->assertDatabaseHas('users',
            ['email' => 'test@example.com']);



        //Create any user except an IT user(since only they can create users)
        $user2 = User::factory()->create();
        $user2->user_type = rand(1,10); //Any user type except IT user

        $this->actingAs($user2)->post('/create-user', [
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test2@example.com',
            'password' => 'password',
            'user_type' => rand(0, 3),
            'password_confirmation' => 'password',
        ]);

        $this->assertDatabaseMissing('users',
            ['email' => 'test2@example.com']);
    }

    public function test_logout()
    {
        $user = User::factory()->create();

        //login using $user
        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        //assert that we are in fact logged in
        $this ->assertAuthenticated();

        //run logout route
        $this->actingAs($user)->post('/logout');

        //assert that we are in fact logged out
        $this -> assertGuest();

    }



}
