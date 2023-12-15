<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Mail\SetPasswordMail;
use Masmerise\Toaster\Toaster;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class Index extends Component
{
    use WithPagination;
    public $perPage = 5;

    public $search = '';
    public $status = 'active';

    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    public function show(int $id)
    {
        $this->dispatch('showing-user', id: $id);
        $this->dispatch('open-modal', 'show-user');
    }

    public function edit(User $user)
    {
        $this->dispatch('editing-user', user: $user);
        $this->dispatch('open-modal', 'edit-user');
    }

    public function delete(User $user)
    {
        $user->delete();
    }

    public function restore(int $id)
    {
        User::withTrashed()->where('id', $id)->first()->restore();
    }


    public function resetPassword(User $user)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randomString = '';

        for ($i = 0; $i < 8; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        $newPassword = Hash::make($randomString);

        $user->update([
            'password' => $newPassword
        ]);

        $getUser = User::where('id', $user->id)->first();
        Mail::to($getUser->email)->send(new SetPasswordMail($getUser, $randomString));
        Toaster::success('An email has been sent for password reset');
    }

    public function render()
    {
        $users = User::withTrashed()
            ->with('roles.permissions')
            ->whereNot('id', [auth()->id()])
            ->search($this->search)
            ->when($this->status !== '', function ($query) {
                $query->when($this->status === 'active', function ($query) {
                    $query->whereNull('deleted_at');
                })->when($this->status === 'inactive', function ($query) {
                    $query->whereNotNull('deleted_at');
                });
            })
            ->orderBy($this->sortBy, $this->sortDir)
            // ->get();
            ->paginate($this->perPage);
        // dd($users);

        return view('livewire.user.index', ['users' => $users]);
    }
}
