<div class="mb-3">
    <div class="pt-2">
        <div class="mt-3">
            <div class="md-form md-outline mb-0">
                @if(! session()->has('coupon'))
                    <form wire:submit.prevent="addCode">
                        <div class="form-group">
                            <input type="text" wire:model="discountCode" class="form-control font-weight-light"
                                   placeholder="Enter discount code">
                            @error('discountCode') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Apply</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
