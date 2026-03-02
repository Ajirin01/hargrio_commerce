<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Product;

class ProductModal extends Component
{
    public $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function render()
    {
        return view('components.product-modal');
    }
}