<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreProductRequest;


class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }


    public function index(Request $request): JsonResponse
    {
        $sortBy = $request->input('sort_by', 'name'); 
        $perPage = $request->input('per_page', 10); 
        $categoryId = $request->input('category_id'); 
    
        if ($categoryId) {
            $products = $this->productService->listProductsByCategory($categoryId, $sortBy, $perPage);
        } else {
            $products = $this->productService->listProducts($sortBy, $perPage);
        }
        
        return response()->json($products);
    }
    


    public function store(StoreProductRequest $request): JsonResponse
    {

        $validatedData = $request->validated();
        
        if ($request->hasFile('image')) {
             $imageName = time().'.'.$request->image->extension();
             $request->image->move(public_path('images'), $imageName); 
             $validatedData['image'] = $imageName; 
        }

        $product = $this->productService->createProduct($validatedData);

        return response()->json($product, 201); 
    }



    public function show($id): JsonResponse
    {
        $product = $this->productService->findProductById($id); 
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }


    public function destroy($id): JsonResponse
    {
        $this->productService->deleteProduct($id);
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
