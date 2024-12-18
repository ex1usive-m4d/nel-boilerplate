<?php

namespace App\NelReports\Application\Services;

use App\NelReports\Application\Interfaces\NelReportRepositoryInterface;
use App\NelReports\Domain\NelReport;
use App\NelReports\Infrastructure\Services\SentryService;

class NelReportService
{
    private NelReportRepositoryInterface $repository;
    private SentryService $sentryService;

    public function __construct(NelReportRepositoryInterface $repository, SentryService $sentryService)
    {
        $this->repository = $repository;
        $this->sentryService = $sentryService;
    }

    public function handle(array $data): void
    {
        $report = new NelReport(
            $data['report_id'],
            $data['error_type'],
            $data['message'],
            new \DateTimeImmutable($data['timestamp'])
        );

        // Сохранение отчета (опционально)
        $this->repository->save($report);

        // Отправка в Sentry
        $this->sentryService->send($report);
    }
}