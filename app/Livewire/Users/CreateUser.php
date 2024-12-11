<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class CreateUser extends Component
{
    public $name ;
    public $email;
    public $password;
    public $password_confirmation;
    public $rol;

    public $roles;


    public function rules()
    {
        return [
            'name' => 'required|min:8',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8' ,
            'password_confirmation' => 'required|same:password',
        ];
    }
    public function mount()
    {
        $this->roles = Role::all();
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, $this->rules());
        
    }

    public function render()
    {
        return view('livewire.users.create-user',['roles' => $this->roles]);
    }

    public function save()
    {
            $validated = $this->validate();
            $user = User::create($validated);
            $user->assignRole($this->rol);
            $this->reset(['name','email','password','password_confirmation','rol']);
            $this->dispatch('render');

    }
}
