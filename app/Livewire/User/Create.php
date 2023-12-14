<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Masmerise\Toaster\Toaster;
use Illuminate\Support\Facades\Hash;

class Create extends Component
{
    public string $name;
    public string $email;
    public string $role;

    public function register()
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
        ]);

        $validated['password'] = Hash::make('password');
        $validated['created_by'] = auth()->id();

        $user = User::create($validated);

        $user->assignRole($this->role);
        Toaster::success('User created');
        return redirect()->route('users');

        // event(new Registered(($user = User::create($validated))));

        // auth()->login($user);

        // $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }

    public function render()
    {
        return view('livewire.user.create');
    }
}
