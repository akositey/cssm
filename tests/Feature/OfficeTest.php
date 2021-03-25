<?php

namespace Tests\Feature;

use App\Models\Office;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OfficeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->office = Office::factory()->create();

    }

    /**
     * @test
     */
    public function logged_out_user_cant_view_offices_list()
    {
        $response = $this->get(route('offices.index'));
        $response->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function logged_in_user_can_view_offices_list()
    {
        $this->actingAs($this->user)
            ->get(route('offices.index'))
            ->assertStatus(200);

    }

    /**
     * @test
     */
    public function logged_in_user_can_create_an_office()
    {
        $officeData = [
            'name' => 'Something Some Office',
            'nick' => 'SSO'
        ];
        $response = $this->actingAs($this->user)->post(route('offices.store'), $officeData);
        $response->assertRedirect(route('offices.index'));
        $this->assertDatabaseHas('offices', [
            'id' => $this->office->id,
            'name' => $this->office->name
        ]);
        $this->assertDatabaseHas('offices', [
            'name' => 'Something Some Office',
            'nick' => 'SSO'
        ]);
    }

    /**
     * @test
     */
    public function logged_in_user_can_update_an_office()
    {
        $origOffice = $this->office;
        $newOffice = $origOffice->toArray();
        $newOffice['name'] = 'New Office Name';
        $response = $this->actingAs($this->user)->patch(route('offices.update', ['office' => $origOffice]), $newOffice);
        $response->assertRedirect(route('offices.index'));
        $this->assertDatabaseHas('offices', [
            'id' => $this->office->id,
            'name' => 'New Office Name'
        ]);
    }

    /**
     * @test
     */
    public function logged_in_user_can_delete_an_office()
    {
        $response = $this->actingAs($this->user)->delete(route('offices.destroy', $this->office));
        $response->assertRedirect(route('offices.index'));
        $this->assertDatabaseMissing('offices', [
            'id' => $this->office->id
        ]);
    }
}
