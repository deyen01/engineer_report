<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Report;
use App\Models\Device;
use App\Models\User;
use App\Exports\ReportsExport;

class ReportController extends Controller
{
    public function list()
    {
        return view('report-list', ['reports' => Report::limitByUser()->orderByDesc('id')->paginate(20)]);
    }

    public function edit($id = 0)
    {
        if ($id > 0) {
            return view('report-edit', ['report' => Report::where(['user_id' => Auth::id(), 'id' => $id])->first()]);
        } else {
            return view('report-edit');
        }
    }

    public function check($id)
    {
        if(Auth::user()->access_level > 0)
        {
            return view('report-check', ['report' => Report::findOrFail($id)]);
        } else {
            return response(null, 403);
        }
    }

    public function savecheck(Request $request, $id)
    {
        if(Auth::user()->access_level > 0)
        {
            $report = Report::findOrFail($id);
            $validatedData = $request->validate([
                'status' => ['required', 'numeric'],
                'reason' => ['nullable', 'string', 'max:255']
            ]);
            $report->fill($validatedData);
            $report->moderator_id = Auth::id();
            $report->save();
            return redirect()->route('reports');
        } else {
            return response(null, 403);
        }
    }

    public function store(Request $request, $id = 0)
    {
        if ($id > 0)
        {
            $report = Report::where(['user_id' => Auth::id(), 'id' => $id])->first();
        } else {
            $report = new Report;
        }
        $validatedData = $request->validate([
            'type_of_work' => ['nullable', 'numeric'],
            'date_executed' => ['required', 'date'],
            'number_ticket' => ['nullable', 'string', 'max:255'],
            'number_device' => ['nullable', 'string', 'max:64'],
            'mileage' => ['nullable', 'numeric'],
            'comment' => ['nullable', 'string', 'max:255']
        ]);
        $report->fill($validatedData);
        $device = false;
        if (strlen($report->number_device) > 0) {
            $device = Device::limitByUser()->where(['number' => $report->number_device])->first();
        }
        if ($device) {
            $report->location = $device->location->title;
            $report->address = $device->address;
            $report->title_client = $device->client->title;
        }
        $report->status = 1;
        $report->save();
        return redirect()->route('reports');
    }

    public function delete($id)
    {
        if ($id > 0)
        {
            $report = Report::where(['user_id' => Auth::id(), 'id' => $id])->first();
            if ($report) {
                $report->delete();
            }
            return redirect()->route('reports');
        }
    }

    public function xlsx() 
    {
        return Excel::download(new ReportsExport, 'Reports.xlsx');
    }
}