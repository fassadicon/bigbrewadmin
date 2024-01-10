<div class="flex-1 flex flex-row" >
    @livewire('pos.order-summary', [], ['order' => 2])
    <div class="flex-1">
        <div>
            @livewire('pos.product-card', ['status' => 1])
        </div>
    </div>
</div>
