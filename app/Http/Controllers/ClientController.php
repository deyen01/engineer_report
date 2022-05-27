<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Client;
use App\Exports\ClientsExport;

class ClientController extends Controller
{
    public function list()
    {
        if(Auth::user()->access_level > 0)
        {
            return view('client-list', ['clients' => Client::orderByDesc('id')->paginate(20)]);
        } else {
            return response(null, 403);
        }
    }

    public function edit($id = 0)
    {
        if(Auth::user()->access_level == 2)
        {
            {
                if ($id > 0) {
                    return view('client-edit', ['client' => Client::findOrFail($id)]);
                } else {
                    return view('client-edit');
                }
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
                $client = Client::findOrFail($id);
            } else {
                $client = new Client;
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
            $client->fill($validatedData);
            $client->save();
            return redirect()->route('clients');
        } else {
            return response(null, 403);
        }
    }

    public function delete($id)
    {
        if(Auth::user()->access_level == 2)
        {
            Client::destroy($id);
            return redirect()->route('clients');
        } else {
            return response(null, 403);
        }
    }

    public function xlsx() 
    {
        if(Auth::user()->access_level > 0)
        {
            return Excel::download(new ClientsExport, 'Clients.xlsx');
        } else {
            return response(null, 403);
        }
    }
}