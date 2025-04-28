<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        // Apply auth middleware for all routes except index, show, and search
        $this->middleware('auth:sanctum')->except(['index', 'show', 'search']);
    }

    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        $product = Product::create($data);

        return response()->json($product, 201);
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        return response()->json($product);
    }

    /**
     * Update the specified product in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);

        $data = $request->validated();
        $product->update($data);

        return response()->json($product);
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        $product->delete();

        return response()->json(null, 204);
    }

    /**
     * Custom search for products by name.
     */
    public function search(Request $request)
    {
        $name = $request->query('name');

        if (!$name) {
            return response()->json(['error' => 'Name query parameter is required.'], 400);
        }

        $products = Product::where('name', 'like', '%' . $name . '%')->get();

        return response()->json($products);
    }
}
