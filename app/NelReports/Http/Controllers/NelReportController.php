<?php

namespace App\NelReports\Http\Controllers;

use App\Http\Controllers\Controller;
use App\NelReports\Application\Services\NelReportService;
use App\NelReports\Http\Requests\NelReportRequest;
use Illuminate\Http\JsonResponse;

class NelReportController extends Controller
{
    private NelReportService $nelReportService;

    public function __construct(NelReportService $nelReportService)
    {
        $this->nelReportService = $nelReportService;
    }

    public function store(NelReportRequest $request): JsonResponse
    {
        $this->nelReportService->handle($request->validated());

        return response()->json(['message' => 'Report received'], 200);
    }
}