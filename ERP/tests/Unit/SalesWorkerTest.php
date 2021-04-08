<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Bike;
use App\Models\Sale;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class SalesWorkerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Checks if sales page can be rendered.
     */

    public function test_only_authenticated_user_can_access_sales_page()
    {
        //Create accountant user
        $user1 = User::factory()->create();
        $user1->user_type = 8;
        $response = $this->actingAs($user1)->get('/sales');
    
        $response->assertStatus(200);
    
        //Create any except accountant user
        $user2 = User::factory()->create();
        do{
            $user_type = rand(0,10);
        } while(in_array($user_type, array(8)));
        $user2->user_type = $user_type;
        $response2 = $this->actingAs($user2)->get('/sales');

        $response2->assertStatus(302); //Should redirect
    }

    public function test_save_order_works_for_sales_only()
    {
        //Create sales user
        $user = User::factory()->create();
        $user->user_type = 8;

        //Create a test bike
        $test_bike = Bike::create([
            'type' => 'test',
            'size' =>'test',
            'color' => 'test',
            'price' => 12,
            'finish' => 'test',
            'grade' => 'test',
            'quantity_in_stock' => 1222,
        ]);

        $this->actingAs($user)->post('/sales', [
            'bicycleId' => $test_bike->id,
            'quantitySold' => 2,
            'profit' => 300
        ]);
        
        $sales = Sale::all();
        assertEquals(1, $sales->count());

    }
}
