<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Create extends Component
{
    public string $name;
    public string $email;
    public string $role;

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
        ]);

        $validated['password'] = Hash::make('password');
        $validated['created_by'] = auth()->id();

        $user = User::create($validated);

        $user->assignRole($this->role);

        // event(new Registered(($user = User::create($validated))));

        // auth()->login($user);

        // $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }

    public function render()
    {
        return view('livewire.user.create');
    }
}
