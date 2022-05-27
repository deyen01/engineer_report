<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Branch;
use App\Exports\BranchesExport;

class BranchController extends Controller
{
    public function list()
    {
        return view('branch-list', ['branches' => Branch::limitByUser()->orderByDesc('id')->paginate(20)]);
    }

    public function edit($id = 0)
    {
        if(Auth::user()->access_level == 2)
        {
            if ($id > 0) {
                return view('branch-edit', ['branch' => Branch::findOrFail($id)]);
            } else {
                return view('branch-edit');
            }
        } else {
            return response(null, 403);
        }
    }

    public function store(Request $request, $id = 0)
    {
        if(Auth::user()->access_level == 2)
        {
            if ($id > 0) {
                $branch = Branch::findOrFail($id);
            } else {
                $branch = new Branch;
            }
            $validatedData = $request->validate([
                'title' => ['required', 'string', 'max:128'],
                'ogrn' => ['nullable', 'string', 'max:15'],
                'inn' => ['nullable', 'string', 'max:12'],
                'kpp' => ['nullable', 'string', 'max:9'],
                'address' => ['nullable', 'string', 'max:255'],
                'email' => ['nullable', 'string', 'max:255'],
                'tel' => ['nullable', 'string', 'max:12']
            ]);
            $branch->fill($validatedData);
            $branch->save();
            return redirect()->route('branches');
        } else {
            return response(null, 403);
        }
    }

    public function delete($id)
    {
        if(Auth::user()->access_level == 2)
        {
            Branch::destroy($id);
            return redirect()->route('branches');
        } else {
            return response(null, 403);
        }
    }

    public function xlsx() 
    {
        return Excel::download(new BranchesExport, 'Branches.xlsx');
    }
}
