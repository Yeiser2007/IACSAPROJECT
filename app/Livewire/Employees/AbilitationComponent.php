<?php

namespace App\Livewire\Employees;

use App\Models\Abilitations;
use Livewire\Component;
use Livewire\WithPagination;

class AbilitationComponent extends Component
{
    use WithPagination;
    public $search = '';
    public $name;
    public $salary;
    public $idAbilitation=0;
    public $paginationTheme = 'bootstrap';

   

    public function edit($id){
        $abilitation = Abilitations::where('id', $id)->first();
        $this->name = $abilitation->name;
        $this->salary = $abilitation->salary;
        $this->idAbilitation = $abilitation->id;
    }
    public function showDelete($id,$name,$salary){
        $this->idAbilitation = $id;
        $this->name = $name;
        $this->salary = $salary;
    }

    public function delete($id){
        try{
            $abilitation = Abilitations::find($id);
            $abilitation->delete();
            session()->flash('success', 'La abilitacion se elimino correctamente.');
            return redirect()->route('habilitaciones.index');
        }catch(\Exception $e){
            session()->flash('error', 'La abilitacion no se puede eliminar');
            return redirect()->route('habilitaciones.index');
        }
       
    }

    public function update($id){
        $abilitation = Abilitations::where('id', $id)->first();
        $abilitation->name = $this->name;
        $abilitation->salary = $this->salary;
        $abilitation->save();
        session()->flash('success', 'La abilitacion se actualizo correctamente.');
        return redirect()->route('habilitaciones.index');
    }



    public function render()
    {
        $abilitations = Abilitations::where('name', 'like', '%' . $this->search . '%')->paginate(5);
        return view('livewire.employees.abilitation-component',compact('abilitations'));
    }
}
