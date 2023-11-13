<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Create extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        // event(new Registered(($user = User::create($validated))));

        // auth()->login($user);

        // $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }

    public function render()
    {
        return view('livewire.user.create');
    }
}
