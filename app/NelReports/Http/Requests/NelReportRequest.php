<?php

namespace App\NelReports\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NelReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Настройте авторизацию при необходимости
    }

    public function rules(): array
    {
        return [
            'report_id' => 'required|string',
            'error_type' => 'required|string',
            'message' => 'required|string',
            'timestamp' => 'required|date',
        ];
    }
}