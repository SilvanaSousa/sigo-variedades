<?php

namespace App\Http\Controllers;

use App\Actions\RegisterClickAction;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;

class RedirectController extends Controller
{
    public function __construct(
        protected RegisterClickAction $registerClickAction
    ) {}

    public function __invoke(Product $product): RedirectResponse
    {
        $this->registerClickAction->execute($product);

        return redirect()->away($product->affiliate_url);
    }
}
