<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Discount;
use Carbon\Carbon;
use Masmerise\Toaster\Toaster;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;

class CreateDiscountForm extends Form
{
    public $name;
    public $type;
    public $value;
    public $start_date;
    public $end_date;

    public function rules()
    {
        $types = [1, 2];

        return [
            'name' => 'required|string|max:255|unique:discounts,name',
            'type' => [
                'required',
                'numeric',
                Rule::in($types)
            ],
            'value' => 'required|numeric|min:1',
            'start_date' => 'nullable|date|after:yesterday',
            'end_date' => 'nullable|date|after_or_equal:start_date'
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => 'name',
            'type' => 'type',
            'value' => 'value',
            'start_date' => 'start date',
            'end_date' => 'end date',
        ];
    }

    public function store()
    {
        $this->validate();

        $status = 3;
        if (Carbon::parse($this->start_date)->eq(Carbon::today())) {
            $status = 1;
        }

        Discount::create([
            'name' => $this->name,
            'type' => $this->type,
            'value' => $this->value,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $status,
        ]);

        Toaster::success('Discount created!');
    }
}
