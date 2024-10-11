<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }


    public function index(Request $request)
    {
        $sortBy = $request->input('sort_by', 'name'); 
        $products = $this->productService->listProducts($sortBy);
        
        return response()->json($products);
    }


    public function store(Request $request)
    {
       

        $product = $this->productService->createProduct($request->all());

        return response()->json($product, 201); 
    }

    public function destroy($id)
    {
        $this->productService->deleteProduct($id);
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
