<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Position;
use App\Exports\PositionsExport;

class PositionController extends Controller
{
    public function list()
    {
        return view('position-list', ['positions' => Position::orderByDesc('id')->paginate(20)]);
    }

    public function edit($id = 0)
    {
        if(Auth::user()->access_level > 0)
        {
            if ($id > 0) {
                return view('position-edit', ['position' => Position::findOrFail($id)]);
            } else {
                return view('position-edit');
            }
        } else {
            return response(null, 403);
        }
    }

    public function store(Request $request, $id = 0)
    {
        if(Auth::user()->access_level > 0)
        {
            if ($id > 0) {
                $position = Position::findOrFail($id);
            } else {
                $position = new Position;
            }
            $validatedData = $request->validate([
                'title' => ['required', 'string', 'max:64']
            ]);
            $position->fill($validatedData);
            $position->save();
            return redirect()->route('positions');
        } else {
            return response(null, 403);
        }
    }

    public function delete($id)
    {
        if(Auth::user()->access_level > 0)
        {
            Position::destroy($id);
            return redirect()->route('positions');
        } else {
            return response(null, 403);
        }
    }

    public function xlsx() 
    {
        return Excel::download(new PositionsExport, 'Positions.xlsx');
    }
}
