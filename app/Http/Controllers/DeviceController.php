<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Location;
use App\Models\Client;
use App\Models\Device;
use App\Exports\DevicesExport;

class DeviceController extends Controller
{
    public function list()
    {
        return view('device-list', ['devices' => Device::limitByUser()->orderByDesc('id')->paginate(20)]);
    }

    public function edit($id = 0)
    {
        if(Auth::user()->access_level > 0)
        {
            if ($id > 0) {
                return view('device-edit', ['device' => Device::limitByUser()->findOrFail($id), 'locations' => Location::all(), 'clients' => Client::all()]);
            } else {
                return view('device-edit', ['locations' => Location::all(), 'clients' => Client::all()]);
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
                $device = Device::limitByUser()->findOrFail($id);
            } else {
                $device = new Device;
            }
            $validatedData = $request->validate([
                'number' => ['required', 'string', 'max:64'],
                'location_id' => ['nullable', 'numeric'],
                'address' => ['nullable', 'string', 'max:255'],
                'place' => ['nullable', 'string', 'max:255'],
                'vendor' => ['nullable', 'string', 'max:255'],
                'client_id' => ['nullable', 'numeric']
            ]);
            $device->fill($validatedData);
            $device->save();
            return redirect()->route('devices');
        } else {
            return response(null, 403);
        }
    }

    public function delete($id)
    {
        if(Auth::user()->access_level > 0)
        {
            Device::destroy($id);
            return redirect()->route('devices');
        } else {
            return response(null, 403);
        }
    }

    public function xlsx() 
    {
        return Excel::download(new DevicesExport, 'Devices.xlsx');
    }
}
