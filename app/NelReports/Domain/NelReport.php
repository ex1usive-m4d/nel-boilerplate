<?php

namespace App\NelReports\Domain;

class NelReport
{
    private string $reportId;
    private string $errorType;
    private string $message;
    private \DateTimeImmutable $timestamp;

    public function __construct(string $reportId, string $errorType, string $message, \DateTimeImmutable $timestamp)
    {
        $this->reportId = $reportId;
        $this->errorType = $errorType;
        $this->message = $message;
        $this->timestamp = $timestamp;
    }

    public function getReportId(): string
    {
        return $this->reportId;
    }

    public function getErrorType(): string
    {
        return $this->errorType;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getTimestamp(): \DateTimeImmutable
    {
        return $this->timestamp;
    }
}