<?php

namespace App\Livewire;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Title('Users')]

class Users extends Component
{
    use WithFileUploads, WithPagination;

    public $name = '';
    public $password = '';
    public $email = '';
    public $role = 2;
    public $search = '';

    // Edit mode properties
    public $editingUserId = null;
    public $oldAvatar = null;
    public $isEditing = false;

    // #[Validate('image|max:1000')]
    public $avatar;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function createNewUser()
    {
        if ($this->isEditing) {
            // Update user
            $validated = $this->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email:dns|unique:users,email,' . $this->editingUserId,
                'role' => 'required|exists:role,id',
            ]);

            $user = User::findOrFail($this->editingUserId);
            
            // Tambahkan role_id ke validated array
            $validated['role_id'] = $this->role;

            // Update avatar jika ada file baru
            if ($this->avatar) {
                $validated['avatar'] = $this->avatar->store('avatar', 'public');
            }

            // Update password hanya jika diisi
            if ($this->password) {
                $validated['password'] = Hash::make($this->password);
            }

            $user->update($validated);
            $this->cancelEdit();
            session()->flash('success', 'User updated successfully!');
        } else {
            // Create user baru
            $validated = $this->validate([
                'name' => 'required|string|max:255',
                'password' => 'required|string|min:8',
                'email' => 'required|email:dns|unique:users,email',
                'role' => 'required|exists:role,id',
                'avatar' => 'required|image|max:1000',
            ]);

            if ($this->avatar) {
                $validated['avatar'] = $this->avatar->store('avatar', 'public');
            }

            $validated['password'] = Hash::make($validated['password']);
            $validated['role_id'] = $validated['role'];
            unset($validated['role']);
            
            User::create($validated);
            $this->reset(); // untuk reset semua inputan
            $this->search = ''; // reset search juga
            session()->flash('success', 'Admin created successfully!');
        }
    }

    public function cancelEdit()
    {
        $this->editingUserId = null;
        $this->oldAvatar = null;
        $this->isEditing = false;
        $this->reset(['name', 'email', 'role', 'password', 'avatar']);
    }

    public function editUser($userId)
    {
        $user = User::findOrFail($userId);
        $this->editingUserId = $userId;
        $this->isEditing = true;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role_id;
        $this->password = ''; // kosongkan password field saat edit
        $this->oldAvatar = $user->avatar; // simpan path avatar lama
        session()->flash('info', 'Edit user: ' . $user->name);
    }

    public function deleteUser($userId)
    {
        User::findOrFail($userId)->delete();
        session()->flash('success', 'User deleted successfully!');
    }

    public function render()
    {
        $query = User::latest();
        $role = Role::all();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%');
        }

        $data = [
            'users' => $query->paginate(6),
            'roles' => $role,
        ];

        return view('livewire.users', $data);
    }
}
