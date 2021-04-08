<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShippingTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_user_only_accessible_to_shipping()
    {
        //Create Shipping User
        $user1 = User::factory()->create();
        $user1->user_type = 3;
        $response = $this->actingAs($user1)->get('/shipping');

        $response->assertStatus(200); //Should display Shipping page

        //Any User except Shipping
        $user2 = User::factory()->create();
        do{
            $user_type = rand(0,10);
        } while(in_array($user_type, array(4)));
        $user2->user_type = $user_type;
        $response2 = $this->actingAs($user2)->get('/shipping');

        $response2->assertStatus(302); //Should redirect

    }

    public function test_shipping_user_can_toggle_status()
    {
        //Create Shipping User
        $user = User::factory()->create();
        $user->user_type = 3;

        DB::table('orders')->insert([
            'ETA' => '2021-03-15',
            'status' => 'received'
        ]);

        //Get order id in which we want to toggle the status
        $order_id = DB::table('orders')->where('status', 'received')->value('id');

        //Get order
        $order = Order::find($order_id);

        $this->actingAs($user)->get('/mark-received');

        $this->assertDatabaseHas('orders', ['id' => $order_id, 'status' => 'Received']);
    }

}
