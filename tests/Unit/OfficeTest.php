<?php

namespace Tests\Unit;

use App\Models\Office;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OfficeTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    /**
     * @test
     */
    public function it_can_create_an_office()
    {
        $officeName = "Office-" . $this->faker->company;
        $data = [
            'name' => $officeName,
            'nick' => preg_replace('/\b(\w)|./', '$1', $officeName)
            // 'parent_id' => $this->faker->numberBetween(1, 10),
        ];
        $response = $this->post(route('offices.store'), $data);
        $response->assertRedirect(route('offices.index'));
        $this->assertDatabaseHas('offices', [
            'name' => $officeName
        ]);
    }

    /**
     * @test
     */
    public function it_can_update_an_office()
    {
        $origData = Office::factory()->create(['parent_id' => null]);
        $newData = $origData->toArray();
        $newData['name'] = 'New Office Name';
        $response = $this->patch(route('offices.update', $origData), $newData);
        $response->assertRedirect(route('offices.index'));
        $this->assertDatabaseHas('offices', [
            'name' => 'New Office Name'
        ]);
    }

    /**
     * @test
     */
    public function it_can_delete_an_office()
    {
        $origData = Office::factory()->create(['parent_id' => null]);
        $response = $this->delete(route('offices.destroy', $origData));
        $response->assertRedirect(route('offices.index'));
        $this->assertDatabaseMissing('offices', [
            'id' => $origData->id
        ]);
    }
}
