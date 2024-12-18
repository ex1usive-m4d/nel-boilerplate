<?php

namespace App\NelReports\Infrastructure\Repositories;

use App\NelReports\Application\Interfaces\NelReportRepositoryInterface;
use App\NelReports\Domain\NelReport;
use Illuminate\Support\Facades\Log;

class NelReportRepository implements NelReportRepositoryInterface
{
    public function save(NelReport $report): void
    {
        // Реализуйте логику сохранения, например, в базу данных
        // Для примера просто логируем
        Log::info('NEL Report saved', [
            'report_id' => $report->getReportId(),
            'error_type' => $report->getErrorType(),
            'message' => $report->getMessage(),
            'timestamp' => $report->getTimestamp()->format('c'),
        ]);
    }
}