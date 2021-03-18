<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InventoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_user_only_accessible_to_inventory()
    {
        //Create Inventory User
        $user = User::factory()->create();
        $user->user_type = 4;
        $response = $this->actingAs($user)->get('/inventory');

        $response->assertStatus(200);

        //Any User except Inventory
        $user2 = User::factory()->create();
        do{
            $user_type = rand(0,10);
        } while(in_array($user_type, array(4)));
        $user2->user_type = $user_type;
        $response2 = $this->actingAs($user2)->get('/inventory');

        $response2->assertStatus(302); //Should redirect

    }

    public function test_inventory_user_can_create_bike()
    {

        //Create Inventory User
        $user = User::factory()->create();
        $user->user_type = 4;

        $this->actingAs($user)->post('/create-bike', [
            'type' => 'Mountain',
            'size' => '18',
            'price' => 199.99,
            'color' => 'red',
            'finish' => 'Matt',
            'grade' => 'Aluminium',
            'quantity_in_stock' => rand(0, 100)
        ]);

        $this->assertDatabaseHas('bikes',
            [
            'type' => 'Mountain',
            'size' => '18',
            'price' => 199.99,
            'color' => 'red',
            'finish' => 'Matt',
            'grade' => 'Aluminium']
        );
    }

    public function test_inventory_user_can_create_part()
    {

        //Create Inventory User
        $user = User::factory()->create();
        $user->user_type = 4;

        $this->actingAs($user)->post('/create-part', [
            'part_name' => 'Test',
            'part_quantity_in_stock' => rand(0, 100)
        ]);

        $this->assertDatabaseHas('parts', ['part_name' => 'Test']);
    }

    public function test_inventory_user_can_create_material()
    {

        //Create Inventory User
        $user = User::factory()->create();
        $user->user_type = 4;

        $this->actingAs($user)->post('/create-material', [
            'material_name' => 'Test',
            'cost' => 19.95,
            'material_quantity_in_stock' => rand(0, 100)
        ]);

        $this->assertDatabaseHas('materials', ['material_name' => 'Test']);
    }

    public function test_inventory_user_can_delete_bike()
    {

        //Create Inventory User
        $user = User::factory()->create();
        $user->user_type = 4;

        $this->actingAs($user)->post('/create-bike', [
            'type' => 'TestDelete',
            'size' => '18',
            'color' => 'red',
            'finish' => 'Matt',
            'grade' => 'Aluminium',
            'quantity_in_stock' => rand(0, 100)
        ]);

        $bike_id = DB::table('bikes')->where('type', 'TestDelete')->value('id');

        $this->actingAs($user)->get('deleteBike/' . $bike_id);

        $this->assertDatabaseMissing('bikes', ['type' => 'TestDelete']);
    }

    public function test_inventory_user_can_delete_part()
    {

        //Create Inventory User
        $user = User::factory()->create();
        $user->user_type = 4;

        $this->actingAs($user)->post('/create-part', [
            'part_name' => 'TestDelete',
            'part_quantity_in_stock' => rand(0, 100)
        ]);

        $part_id = DB::table('parts')->where('part_name', 'TestDelete')->value('id');

        $this->actingAs($user)->get('deletePart/' . $part_id);

        $this->assertDatabaseMissing('parts', ['part_name' => 'TestDelete']);
    }

    public function test_inventory_user_can_delete_material()
    {

        //Create Inventory User
        $user = User::factory()->create();
        $user->user_type = 4;

        $this->actingAs($user)->post('/create-material', [
            'material_name' => 'TestDelete',
            'cost' => 19.95,
            'material_quantity_in_stock' => rand(0, 100)
        ]);

        $material_id = DB::table('materials')->where('material_name', 'TestDelete')->value('id');

        $this->actingAs($user)->get('deleteMaterial/' . $material_id);

        $this->assertDatabaseMissing('materials', ['material_name' => 'TestDelete']);
    }

    public function test_inventory_user_can_edit_material()
    {

        //Create Inventory User
        $user = User::factory()->create();
        $user->user_type = 4;

        $this->actingAs($user)->post('/create-material', [
            'material_name' => 'TestEdit',
            'cost' => 19.95,
            'material_quantity_in_stock' => 100
        ]);

        $material_id = DB::table('materials')->where('material_name', 'TestEdit')->value('id');

        $this->actingAs($user)->post('/edit-material', [
            'id' => $material_id,
            'material_name' => 'TestEdit',
            'cost' => 19.95,
            'material_quantity_in_stock' => 2
        ]);

        $this->assertDatabaseHas('materials', ['id' => $material_id, 'material_quantity_in_stock' => 2]);
    }

    public function test_inventory_user_can_edit_part()
    {
        //Create Inventory User
        $user = User::factory()->create();
        $user->user_type = 4;

        $this->actingAs($user)->post('/create-part', [
            'part_name' => 'TestEdit',
            'part_quantity_in_stock' => 100
        ]);

        $part_id = DB::table('parts')->where('part_name', 'TestEdit')->value('id');

        $this->actingAs($user)->post('/edit-part', [
            'id' => $part_id,
            'part_name' => 'TestEdit',
            'part_quantity_in_stock' => 2
        ]);

        $this->assertDatabaseHas('parts', ['id' => $part_id, 'part_quantity_in_stock' => 2]);
    }
}
