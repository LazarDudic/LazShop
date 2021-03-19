<div>
    @if($leaveReview === false)
        <div class="text-center mt-3">
            <button class="btn btn-success w-50" wire:click="openForm">Leave a Review</button>
        </div>
    @else
    <div class="card my-4">
        <h5 class="card-header">Leave a Review:</h5>

        <div class="card-body">
            <form wire:submit.prevent="store">
                @csrf
                <div class="d-flex">
                    <div class="ml-3">
                        <input type="radio" wire:model="rating" value="1"/>
                        <h5>1</h5>
                    </div>
                    <div class="ml-3">
                        <input type="radio" wire:model="rating"  value="2"/>
                        <h5>2</h5>
                    </div>
                    <div class="ml-3">
                        <input type="radio" wire:model="rating"  value="3"/>
                        <h5>3</h5>
                    </div>
                    <div class="ml-3">
                        <input type="radio" wire:model="rating"  value="4"/>
                        <h5>4</h5>
                    </div>
                    <div class="ml-3">
                        <input type="radio" wire:model="rating"  value="5"/>
                        <h5>5</h5>
                    </div>
                </div>
                @error('rating') <span class="text-danger">{{ $message }}</span> @enderror

                <div class="form-group">
                    <textarea wire:model="comment"  class="form-control" rows="3"></textarea>
                    @error('comment') <span class="text-danger">{{ $message }}</span> @enderror

                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    @endif
</div>

