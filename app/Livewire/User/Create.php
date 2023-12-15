<?php

namespace App\Livewire\User;

use App\Mail\SetPasswordMail;
use App\Models\User;
use Livewire\Component;
use Masmerise\Toaster\Toaster;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class Create extends Component
{
    public string $name;
    public string $email;
    public string $role;

    public function mount()
    {
        $this->role = 'Employee';
    }

    public function register()
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
        ]);

        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randomString = '';

        for ($i = 0; $i < 8; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        $validated['password'] = Hash::make($randomString);
        $validated['created_by'] = auth()->id();

        $user = User::create($validated);

        $user->assignRole($this->role);

        Mail::to($user->email)->send(new SetPasswordMail($user, $randomString));
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
