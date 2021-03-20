<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ShowProducts extends Component
{
    public $categoryId;
    public $sortField = 'created_at';
    private $sortDirection;
    public $search = '';
    public $take = 9;
    private $activeSortFields = [
        'created_at',
        'price_high',
        'price_low',
        'rating',
        'orders',
    ];

    private function getSortField()
    {
        abort_if(! in_array($this->sortField, $this->activeSortFields), 404);
        $this->sortDirection = 'desc';

        if (preg_match('/low/', $this->sortField)) {
            $this->sortDirection = 'asc';
            $sortField = str_replace('_low', '', $this->sortField);
        }

        if (preg_match('/high/', $this->sortField)) {
            $sortField = str_replace('_high', '', $this->sortField);
        }

        return $sortField ?? $this->sortField;
    }

    public function seeMore()
    {
        $this->take += 9;
    }

    public function render()
    {
        $sortField = $this->getSortField();

        $products = Product::search($this->search, ['name', 'description'])
                           ->when($this->categoryId, function($query) {
                               return $query->where('category_id', $this->categoryId);
                           })
                           ->where('status', 1)
                           ->where('quantity', '>', 0)
                           ->withCount(['orderItems as orders', 'reviews as rating' => function($query) {
                               $query->select(DB::raw('coalesce(avg(rating),0)'));
                           }])
                           ->orderBy($sortField, $this->sortDirection)
                           ->take($this->take)
                           ->get();

        return view('livewire.product.show-products', [
            'products' => $products
        ]);
    }

}
