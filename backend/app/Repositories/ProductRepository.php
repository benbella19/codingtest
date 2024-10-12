<?php
namespace App\Repositories;

use App\Models\Product;

class ProductRepository {
    
    public function create(array $data) {
        return Product::create($data);
    }

    public function delete($id) {
        return Product::findOrFail($id)->delete();
    }

    public function find($id) {
        return Product::with('category')->findOrFail($id);
    }

    public function paginate($perPage = 10, $sortBy = 'name')
    {
        return Product::orderBy($sortBy)->paginate($perPage);
    }

    public function findByCategory($categoryId, $perPage = 10, $sortBy = 'name')
    {
        return Product::where('category_id', $categoryId)
                    ->orderBy($sortBy)
                    ->paginate($perPage);
    }


}
