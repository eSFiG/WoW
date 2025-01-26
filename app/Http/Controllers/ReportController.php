<?php

namespace App\Http\Controllers;

use App\Http\Requests\DateRangeRequest;
use App\Models\Report;
use App\Models\Type;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ReportController
{
    public function getReportView(): View
    {
        return view('report');
    }

    public function getReportsInDateRange(DateRangeRequest $request): JsonResponse
    {
        $data = $request->validated();

        $reports = Report::where('date', '>=', $data['date_from'])->where('date', '<=', $data['date_to'])->get();
        $reportsGroupedByName = $reports->sortBy('type')->groupBy('name')->all();

        return response()->json($reportsGroupedByName);
    }
}
