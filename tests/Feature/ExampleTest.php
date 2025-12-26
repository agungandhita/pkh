<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_laporan_download_returns_attachment(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.laporan.pdf'));

        $response->assertOk();
        $response->assertHeader('content-type', 'application/pdf');
        $response->assertHeader('content-disposition');
        $response->assertHeaderContains('content-disposition', 'attachment; filename=');
        $response->assertHeaderContains('content-disposition', '.pdf');
    }
}
