<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Livewire\Component;

class ShowProducts extends Component
{
    public $categoryId;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $search = '';
    public $take = 9;
    private $activeSortFields = [
        'created_at',
        'price_high',
        'price_low',
    ];

    private function getSortField()
    {
        abort_if(! in_array($this->sortField, $this->activeSortFields), 404);

        if (preg_match('/low/', $this->sortField)) {
            $this->sortDirection = 'asc';
            $sortField = str_replace('_low', '', $this->sortField);
        }

        if (preg_match('/high/', $this->sortField)) {
            $this->sortDirection = 'desc';
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

        if ($this->categoryId) {
            $products = Product::search($this->search, ['name', 'description'])
                               ->where('category_id', $this->categoryId)
                               ->where('status', 1)
                               ->where('quantity', '>', 0)
                               ->orderBy($sortField, $this->sortDirection)
                               ->take($this->take)
                               ->get();
        } else {
            $products = Product::search($this->search, ['name', 'description'])
                               ->where('status', 1)
                               ->where('quantity', '>', 0)
                               ->orderBy($sortField, $this->sortDirection)
                               ->take($this->take)
                               ->get();
        }

        return view('livewire.product.show-products', [
            'products' => $products
        ]);
    }

}
