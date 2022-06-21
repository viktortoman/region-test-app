<?php

namespace Tests\Feature;

use Tests\TestCase;

class CountryTest extends TestCase
{

    /**
     * test find product.
     *
     * @return void
     */
    public function test_find_country(): void
    {
        $response = $this->get('api/countries/1');

        $response->assertStatus(200);
    }

    /**
     * test get all products.
     *
     * @return void
     */
    public function test_get_all_countries(): void
    {
        $response = $this->get('api/countries');

        $response->assertStatus(200);
    }

    /**
     * test update product.
     *
     * @return void
     */
    public function test_update_country(): void
    {
        $response = $this->put('api/countries/1', [
            'name' => 'Iceland',
            'capital' => 'Reykjavik'
        ]);

        $response->assertStatus(200);
    }
}
