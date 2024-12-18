<?php

namespace App\NelReports\Infrastructure\Services;

use App\NelReports\Domain\NelReport;
use Sentry\State\HubInterface;

class SentryService
{
    private HubInterface $sentryHub;

    public function __construct(HubInterface $sentryHub)
    {
        $this->sentryHub = $sentryHub;
    }

    public function send(NelReport $report): void
    {
        $this->sentryHub->captureMessage(sprintf(
            'NEL Report: %s - %s',
            $report->getErrorType(),
            $report->getMessage()
        ), \Sentry\Severity::error());
    }
}