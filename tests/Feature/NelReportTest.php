<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use App\NelReports\Application\Services\NelReportService;

class NelReportTest extends TestCase
{
    use RefreshDatabase;

    public function test_nel_report_can_be_submitted()
    {
        // Мокаем NelReportService
        $nelReportServiceMock = Mockery::mock(NelReportService::class);
        $nelReportServiceMock->shouldReceive('handle')->once();
        $this->app->instance(NelReportService::class, $nelReportServiceMock);

        $payload = [
            'report_id' => '12345',
            'error_type' => 'network_error',
            'message' => 'Failed to load resource',
            'timestamp' => '2024-12-10T12:34:56Z',
        ];

        $response = $this->postJson('/api/nel-reports', $payload);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Report received']);
    }
}