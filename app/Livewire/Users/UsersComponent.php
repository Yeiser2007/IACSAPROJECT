<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersComponent extends Component
{
    use WithPagination;
    public $search;
    protected $paginationTheme = 'bootstrap';   
    public $sort='id';
    public $direction = 'asc';
    protected $listeners = ['render' => 'render'];

    public $name;
    public $id;

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {

        $users = User::where('name', 'like', '%' . $this->search . '%')
        ->orWhere('email', 'like', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)
        ->paginate();

           return view('livewire.users.users-component', compact('users'));
        }
        public function order($sort){
            if($this->sort == $sort){
                $this->direction = $this->direction == 'asc' ? 'desc' : 'asc';
            }else{
                $this->sort = $sort;
                $this->direction = 'asc';
            }
            $this->sort = $sort;
        }
        public function destroy($id){
            $user = User::find($id);
            $user->delete();
            $this->dispatch('deleteUser');
        }
        public function assignName($id,$name){
            $this->name = $name;
            $this->id = $id;
        }

}
