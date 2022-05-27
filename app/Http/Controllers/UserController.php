<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use App\Models\Position;
use App\Models\Location;
use App\Models\Branch;
use App\Exports\UsersExport;

class UserController extends Controller
{
    public function list()
    {
        return view('user-list', ['users' => User::limitAL()->orderByDesc('id')->paginate(20)]);
    }

    public function edit($id = 0)
    {
        if(Auth::user()->access_level == 2)
        {
            if ($id > 0) {
                return view('user-edit', ['user' => User::findOrFail($id), 'positions' => Position::all(), 'locations' => Location::all(), 'branches' => Branch::all()]);
            } else {
                $newpass = Str::random(16);
                session(['newpass' => $newpass]);
                return view('user-edit', ['newpass' => $newpass, 'positions' => Position::all(), 'locations' => Location::all(), 'branches' => Branch::all()]);
            }
        } else {
            return response(null, 403);
        }
    }

    public function updatepwd($id)
    {
        $newpass = Str::random(16);
        session(['newpass' => $newpass]);
        return view('user-pwd', ['user' => User::limitAL()->findOrFail($id), 'newpass' => $newpass]);
    }

    public function savepwd($id)
    {
        $user = User::limitAL()->findOrFail($id);
        $user->password = Hash::make(session('newpass'));
        $user->save();
        session()->forget('newpass');
        return redirect()->route('users');
    }

    public function store(Request $request, $id = 0)
    {
        if(Auth::user()->access_level == 2)
        {
            $validar = [
                'email' => ['nullable', 'email', 'max:250'],
                'family' => ['nullable', 'string', 'max:255'],
                'name' => ['nullable', 'string', 'max:255'],
                'ibn' => ['nullable', 'string', 'max:255'],
                'inn' => ['nullable', 'string', 'max:12'],
                'position_id' => ['nullable', 'numeric'],
                'tel' => ['nullable', 'string', 'max:12'],
                'location_id' => ['nullable', 'numeric'],
                'address' => ['nullable', 'string', 'max:255'],
                'branch_id' => ['nullable', 'numeric'],
                'access_level' => ['nullable', 'numeric'],
                'enabled' => ['required', 'boolean']
            ];
            if ($id > 0) {
                $user = User::limitAL()->findOrFail($id);
            } else {
                $validar['email'] = ['required', 'email', 'max:250', 'unique:users'];
                $user = new User;
                $user->password = Hash::make(session('newpass'));
                session()->forget('newpass');
            }
            $validatedData = $request->validate($validar);
            $user->fill($validatedData);
            $user->save();
            return redirect()->route('users');
        } else {
            return response(null, 403);
        }
    }

    public function delete($id)
    {
        if(Auth::user()->access_level == 2)
        {
            if (Auth::user()->access_level = 2)
            {
                User::destroy($id);
            }
            return redirect()->route('users');
        } else {
            return response(null, 403);
        }
    }

    public function xlsx() 
    {
        return Excel::download(new UsersExport, 'Users.xlsx');
    }

}
