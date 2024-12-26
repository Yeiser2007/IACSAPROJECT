<?php

namespace App\Http\Controllers;

use App\Models\Abilitations;
use Illuminate\Http\Request;

class Abilitation extends Controller
{
    public function index()
    {
        return view('employees.abilitations');
    }
    public function addAbilitation(Request $request){
        $abilitation = new Abilitations();
        $abilitation->name = $request->name;
        $abilitation->salary = $request->salary;
        $abilitation->save();
        
        session()->flash('success', 'La abilitacion se registro correctamente.');
        return redirect()->route('habilitaciones.index');
    }
   
}
