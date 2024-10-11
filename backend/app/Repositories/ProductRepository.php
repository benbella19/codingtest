<?php
namespace App\Repositories;

use App\Models\Product;

class ProductRepository {
    public function all($sortBy = 'name') {
        return Product::with('category')->orderBy($sortBy)->paginate(10);
    }

    public function create(array $data) {
        return Product::create($data);
    }

    public function delete($id) {
        return Product::findOrFail($id)->delete();
    }

    public function find($id) {
        return Product::with('category')->findOrFail($id);
    }
}
