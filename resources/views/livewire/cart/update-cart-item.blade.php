<div>
    <div class="">
        <div class="d-flex h-75">
            <button wire:click="decrease()" class="btn btn-danger btn-sm">
                <i class="fas fa-minus"></i>
            </button>

            <input class="w-25 text-center" wire:model.debounce.1500ms="cartItemQuantity" type="number" min="1"
                   value="{{ $cartItemQuantity }}">

            <button wire:click="increase()"  class="btn btn-success btn-sm" >
                <i class="fas fa-plus"></i>
            </button>
        </div>

        <div class=" text-secondary">
            <p>({{ $cartItem->model->quantity - $cartItem->qty }}) peaces left</p>
        </div>
    </div>
    <div class="d-flex mt-3 justify-content-between">
        <span>
            Unit Price: ${{ priceFormat($cartItem->price, 2)}}
        </span>
        <span>
            Total Price:
            <strong>
                ${{ priceFormat($cartItem->price * $cartItem->qty, 2)}}
            </strong>
        </span>
    </div>

    <div class="d-flex justify-content-between">
        <button wire:click="remove()" type="button" class="btn btn-link btn-sm text-uppercase"><i
                class="fas fa-trash-alt mr-1"></i> Remove item </button>
        <button href="#!" type="button" class="btn btn-link btn-sm text-uppercase"><i
                class="fas fa-heart mr-1"></i> Move to wish list </button>
    </div>

</div>
