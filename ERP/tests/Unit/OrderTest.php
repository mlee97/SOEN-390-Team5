<?php

namespace Tests\Unit;


use App\Models\Material;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Carbon;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class OrderTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_order()
    {
        $user = User::factory()->create();
        $user -> user_type = 4;

        //The Order entity needs a reference to a bike
        $test_mat = new Material();
        $test_mat -> material_name = 'test_mat';
        $test_mat -> material_quantity_in_stock = 1;
        $test_mat -> cost = 24.99;
        $test_mat -> save();


        $this->actingAs($user)->post('/create-order', [
            'ETA' => Carbon::now(),
            'status' => 'Delivered',
            'MAT1' => $test_mat->id,
            'ODR_QTY1' => 33
        ]);

        $material = Material::all();
        $order = Order::all();
        assertEquals(1, $material->count());
        assertEquals(1, $order->count());
    }
}
