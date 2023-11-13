<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\User;
use Livewire\Attributes\Rule;

class EditUserForm extends Form
{
    public User $user;
    public $name;
    public $email;
    public $role;

    // public function rules()
    // {
    //     return [
    //         'name' => 'required|string|max:255|unique:product_categories,name,' . $this->size->id,
    //         'measurement' => 'required',
    //         'description' => 'nullable|string'
    //     ];
    // }

    // public function validationAttributes()
    // {
    //     return [
    //         'name' => 'name',
    //         'measurement' => 'measurement',
    //         'description' => 'description'
    //     ];
    // }

    public function loadFields(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
    }

    // public function update()
    // {
    //     $this->validate();

    //     $this->size->update([
    //         'name' => $this->name,
    //         'measurement' => $this->measurement,
    //         'description' => $this->description,
    //     ]);
    // }
}
