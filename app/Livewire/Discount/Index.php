<?php

namespace App\Livewire\Discount;

use Livewire\Component;
use App\Models\Discount;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;
use App\Livewire\Forms\CreateDiscountForm;

class Index extends Component
{
    use WithPagination;
    public $perPage = 5;

    public $search = '';
    public $status = '';

    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    public CreateDiscountForm $form;

    public function store()
    {
        $this->form->store();
        $this->form->reset();
    }

    public function show(int $id)
    {
        $this->dispatch('showing-discount', id: $id);
        $this->dispatch('open-modal', 'show-discount');
    }

    public function edit(Discount $discount)
    {
        $this->dispatch('editing-discount', discount: $discount);
        $this->dispatch('open-modal', 'edit-discount');
    }

    public function delete(Discount $discount)
    {
        $discount->delete();
        Toaster::warning('Discount archived!');
    }

    public function restore(int $id)
    {
        Discount::withTrashed()->where('id', $id)->first()->restore();
        Toaster::success('Discount restored!');
    }

    #[On('discount-changed')]
    public function refresh()
    {
    }

    public function render()
    {
        $discounts = Discount::withTrashed()
            ->search($this->search)
            ->when($this->status !== '', function ($query) {
                $query->when($this->status === 'active', function ($query) {
                    $query->whereNull('deleted_at');
                })->when($this->status === 'inactive', function ($query) {
                    $query->whereNotNull('deleted_at');
                });
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.discount.index', ['discounts' => $discounts]);
    }
}
