<div>
    <div class="d-flex mb-0">
        <button wire:click="decrease()" class="btn btn-danger btn-sm">
            <i class="fas fa-minus"></i>
        </button>

        <h4 class="px-4">{{ $cartItem->qty }}</h4>

        <button wire:click="increase()"  class="btn btn-success btn-sm" >
            <i class="fas fa-plus"></i>
        </button>

    </div>
    <div>
        <p class="mt-3"><span><strong id="summary">Price: ${{ number_format($cartItem->price, 2) }}</strong></span></p>
    </div>

    <div class="d-flex justify-content-between">
        <button wire:click="remove()" type="button" class="btn btn-link btn-sm text-uppercase"><i
                class="fas fa-trash-alt mr-1"></i> Remove item </button>
        <button href="#!" type="button" class="btn btn-link btn-sm text-uppercase"><i
                class="fas fa-heart mr-1"></i> Move to wish list </button>
    </div>

</div>

