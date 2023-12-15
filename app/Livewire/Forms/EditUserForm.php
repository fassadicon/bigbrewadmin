<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\User;
use Livewire\Attributes\Rule;
use Masmerise\Toaster\Toaster;

class EditUserForm extends Form
{
    public User $user;
    public $name;
    public $email;
    public $role;

    public function loadFields(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
    }

    public function update()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class . ',email,' . $this->user->id],
        ]);

        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randomString = '';

        for ($i = 0; $i < 8; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        $validated['created_by'] = auth()->id();

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email
        ]);

        $this->user->assignRole($this->role);

        Toaster::success('User updated');
        return redirect()->route('users');
    }
}
