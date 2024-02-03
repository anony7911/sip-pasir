<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ManajemenUser extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $name, $email, $password, $user_id, $role;
    public $paginate = 10;


    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate($this->paginate, pageName: 'users');
        return view('livewire.manajemen-user', compact('users'))->title('Manajemen User');
    }

    public function resetInput()
    {
        $this->name = null;
        $this->email = null;
        $this->password = null;
        $this->user_id = null;
        $this->role = null;
    }

    public function store(){
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'required'
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'name.min' => 'Nama minimal 3 karakter',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password tidak boleh kosong',
            'role.required' => 'Role tidak boleh kosong'
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => \Hash::make($this->password),
            'role' => $this->role
        ]);

        $this->resetInput();
        session()->flash('message', 'User berhasil ditambahkan');
		$this->dispatch('closeModal');
    }

    public function edit($id){
        $user = User::find($id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
    }

    public function update(){
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,'.$this->user_id,
            'role' => 'required'
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'name.min' => 'Nama minimal 3 karakter',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'role.required' => 'Role tidak boleh kosong'
        ]);

        $user = User::find($this->user_id);

        if($this->password != null){
            $this->validate([
                'password' => 'required'
            ], [
                'password.required' => 'Password tidak boleh kosong'
            ]);
            $user->update([
                'password' => \Hash::make($this->password),
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role

            ]);
        }else{
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role
            ]);
        }

        $this->resetInput();
        session()->flash('message', 'User berhasil diupdate');
        $this->dispatch('closeModal');
    }

    public function delete($id){
        $user = User::find($id);
        $user->delete();
        session()->flash('message', 'User berhasil dihapus');
    }
}
