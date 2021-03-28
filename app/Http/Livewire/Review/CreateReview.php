<?php

namespace App\Http\Livewire\Review;

use App\Models\Product;
use App\Models\Review;
use Livewire\Component;

class CreateReview extends Component
{
    public Product $product;
    public $leaveReview = false;
    public $rating;
    public $comment;

    protected $rules = [
        'rating' => ['required', 'integer', 'min:1', 'max:5'],
        'comment' => ['required', 'max:1000'],
    ];

    public function store()
    {
        $data = $this->validate();
        $data['user_id'] = auth()->id();
        $data['product_id'] = $this->product->id;

        Review::create($data);

        session()->flash('success', 'Review posted successfully.');

        return redirect(route('products.show', $this->product->id));
    }

    public function openForm()
    {
        $this->leaveReview = true;
    }

    public function render()
    {
        return view('livewire.review.create-review');
    }
}
