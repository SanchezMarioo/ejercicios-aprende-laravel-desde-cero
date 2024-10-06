<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRules = [
        'name' => 'required|string|max:64',
        'description' => 'required|string|max:512',
        'price' => 'required|integer|min:1',
    ];

    public function store(Request $request)
    {
        $data = $request->validate($this->productRules);

        $product = auth()->user()->products()->create($data);

        return response()->json([
            'message' => 'Product created successfully',
            'product' => $product,
        ], 201);
    }

    public function update(Request $request, Product $product)
    {
        if ($product->user_id !== auth()->id()) {
            abort(403);
        }
    
        $data = $request->validate($this->productRules);
        $product->update($data);

        return response()->json([
            'message' => 'Product updated successfully',
            'product' => $product,
        ]);

    }
    public function destroy(Product $product)
    {
        if ($product->user_id === auth()->id()) {
            $product->delete();
            return response()->json([
                'message' => 'Product deleted successfully',
                'product' => $product,
            ]);
        } else {
            abort(403);
        }

    }
    public function index()
    {
        $products = auth()->user()->products;

        return response()->json([
            'products' => $products,
        ]);
    }

    public function show(Product $product)
    {
        $this->authorize('view', $product);
    
        return response()->json(compact('product'));
    }
}
