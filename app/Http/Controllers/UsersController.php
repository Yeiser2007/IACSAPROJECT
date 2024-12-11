<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use Maatwebsite\Excel\Facades\Excel;
class UsersController extends Controller
{
    public function index()
    {
        return view('users.users');
    }
    public function create()
    {

    }
    public function store(Request $request)
    {
     
    }
    public function update(Request $request, $user){
        $user=User::findOrFail($user);

        $user->roles()->sync($request->roles);
        return redirect()->route('usuarios.edit', $user)->with('info', 'Rol asignado');
    }

    public function edit($user)
    {
        $roles=  Role::all();

        $user=User::findOrFail($user);
        return view('users.edit-user', compact('user', 'roles'));
    }
    public function exportUsers(){
        return Excel::download(new UsersExport, 'Usuarios.xlsx');
    
    }
}
