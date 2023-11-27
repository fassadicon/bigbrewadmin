<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Spatie\Activitylog\Models\Activity;

class Show extends Component
{
    public User $user;
    public $logs;

    #[On('showing-user')]
    public function fillShow(int $id)
    {
        $this->user = User::withTrashed()
            ->where('id', $id)
            ->first();

        $this->logs = Activity::where('log_name', 'Users')
            ->where('subject_id', $this->user->id)
            ->orderByDesc('created_at')
            ->get();
    }
}
