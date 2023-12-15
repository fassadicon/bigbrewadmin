<?php

namespace App\Livewire\Size;

use App\Models\Size;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;
use Illuminate\Support\Facades\DB;
use App\Livewire\Forms\CreateSizeForm;

class Index extends Component
{
    use WithPagination;
    public $perPage = 5;

    public $search = '';
    public $status = '';

    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    public CreateSizeForm $form;

    public function store()
    {
        $this->form->store();
    }

    public function show(int $id)
    {
        $this->dispatch('showing-product-size', id: $id);
        $this->dispatch('open-modal', 'show-product-size');
    }

    public function edit(Size $size)
    {
        $this->dispatch('editing-product-size', size: $size);
        $this->dispatch('open-modal', 'edit-product-size');
    }

    public function delete(Size $size)
    {
        $size->delete();
        Toaster::warning('Size archived!');
    }

    public function restore(int $id)
    {
        Size::withTrashed()->where('id', $id)->first()->restore();
        Toaster::success('Size restored!');
    }


    public function setSortBy($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDir = $this->sortDir == 'ASC' ? 'DESC' : 'ASC';
            return;
        }

        $this->sortBy = $column;
        $this->sortDir = 'DESC';
    }

    #[On('product-size-changed')]
    public function refresh()
    {
    }

    public function render()
    {
        // Raw Query
        // SELECT * FROM sizes

        // method 1: Query Builder
        // $sizes = DB::table('sizes')->select('*')->get();

        // method 2: Eloquent ORM
        // $sizes = Size::withTrashed()->get();

        // final method with filters and pagination
        $sizes = Size::withTrashed()
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

        return view('livewire.size.index', ['sizes' => $sizes]);
    }
}
