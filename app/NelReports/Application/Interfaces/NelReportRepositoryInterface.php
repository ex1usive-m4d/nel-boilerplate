<?php

namespace App\NelReports\Application\Interfaces;

use App\NelReports\Domain\NelReport;

interface NelReportRepositoryInterface
{
    public function save(NelReport $report): void;
}