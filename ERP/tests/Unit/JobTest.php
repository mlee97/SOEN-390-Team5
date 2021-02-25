<?php

namespace Tests\Unit;

use App\Models\Job;
use App\Models\User;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class JobTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_only_authenticated_user_can_access_job_page()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/jobs');
        $response->assertStatus(200);

        $this->post('/logout'); //deauthenticate

        $response2 = $this->get('/jobs');
        $response2->assertStatus(302);


    }

    public function test_only_authenticated_user_can_access_create_job_page()
    {

        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/create-job');
        $response->assertStatus(200);

        $this->post('/logout'); //deauthenticate

        $response2 = $this->get('/create-job');
        $response2->assertStatus(302);

    }

    public function test_job_creation(){
        $user = User::factory()->create();
        $this->actingAs($user)->post('/create-job', [
            'status'=> 'Queued'
        ]);

        $jobs = Job::all();
        assertEquals(1, $jobs->count());
    }


    public function test_update_job(){

        $user = User::factory()->create();
        $newJob = new Job();
        $newJob->status = "Queued";
        $newJob->save();
        $uri = '/toggle-job-status/'.$newJob->id;

        $this->assertDatabaseHas('jobs', [
            'id' => $newJob->id
        ]);

        $this->actingAs($user)->get($uri);

        $updatedJob = Job::find($newJob->id);

        assertEquals("Complete",$updatedJob->status);
    }

    public function test_delete_job() {

        $user = User::factory()->create();
        $newJob = new Job();
        $newJob->status = "Complete";
        $newJob->save();

        $this->assertDatabaseHas('jobs', [
            'id' => $newJob->id
        ]);

        $this->actingAs($user)->get("/delete-job/".$newJob->id);

        $this->assertDatabaseMissing('jobs', [
            'id' => $newJob->id
        ]);

    }
}
