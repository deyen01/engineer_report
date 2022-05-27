<?php

namespace App\Exports;

use App\Models\Report;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportsExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('exports.reports', ['reports' => Report::limitByUser()->get()]);
    }
}
