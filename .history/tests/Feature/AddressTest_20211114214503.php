<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddressTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function get_address_test()
    {
        Customer::factory(1)->create();
        $this->assertCount(1, Customer::all());
        $customer = Customer::first();

        Address::factory(1)->create(['customer_id' => $customer->id]);

        $this->assertCount(1, Address::all());
        $address = Address::first();

        $this->json('GET', "/api/address/$address->id", [
            'message' => 'Ok',
            'error' => false,
            'code' => 200,
            'result' => [
                'data' => [
                    'id' => $address->id,
                    'label' => $address->label,
                    'type' => $address->type,
                    'road' => $address->road,
                    'block' => $address->block,
                    'number' => $address->number,
                    'bis' => $address->bis,
                    'stairs' => $address->stairs,
                    'floor' => $address->floor,
                    'door' => $address->door,
                    'postal_code' => $address->postal_code,
                    'locality' => $address->province,
                    'province' => $address->province,
                    'country' => $address->country,
                    'customer_id' => $address->customer_id
                ]
            ]
        ])->assertStatus(200);
    }
}
