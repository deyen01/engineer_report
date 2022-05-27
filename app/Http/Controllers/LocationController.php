<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Location;
use App\Exports\LocationsExport;

class LocationController extends Controller
{
    public function list()
    {
        return view('location-list', ['locations' => Location::limitByUser()->orderByDesc('id')->paginate(20)]);
    }

    public function edit($id = 0)
    {
        if(Auth::user()->access_level > 0)
        {
            if ($id > 0) {
                return view('location-edit', ['location' => Location::limitByUser()->findOrFail($id)]);
            } else {
                return view('location-edit');
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
                $location = Location::limitByUser()->findOrFail($id);
            } else {
                $location = new Location;
            }
            $validatedData = $request->validate([
                'title' => ['required', 'string', 'max:64'],
                'oktmo' => ['nullable', 'string', 'max:11']
            ]);
            $location->fill($validatedData);
            $location->save();
            return redirect()->route('locations');
        } else {
            return response(null, 403);
        }
    }

    public function delete($id)
    {
        if(Auth::user()->access_level > 0)
        {
            Location::destroy($id);
            return redirect()->route('locations');
        } else {
            return response(null, 403);
        }
    }

    public function xlsx() 
    {
        return Excel::download(new LocationsExport, 'Locations.xlsx');
    }
}
