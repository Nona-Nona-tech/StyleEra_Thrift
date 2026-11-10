<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductQuestion;
use Illuminate\Http\Request;

class ProductQuestionController extends Controller
{
    public function store(Request $request, string $productId)
    {
        $product = Product::findOrFail($productId);

        $validated = $request->validate([
            'question' => ['required', 'string', 'max:1000'],
        ]);

        ProductQuestion::create([
            'product_id' => $product->id,
            'customer_id' => $request->user()->id,
            'question' => $validated['question'],
            'answer' => null,
        ]);

        return redirect()
            ->route('product.show', ['id' => $product->id])
            ->with('status', 'Your question has been submitted.');
    }
}