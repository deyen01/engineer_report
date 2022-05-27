<?php

namespace App\Exports;

use App\Models\Branch;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BranchesExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('exports.branches', ['branches' => Branch::limitByUser()->get()]);
    }
}
