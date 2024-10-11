<?php
namespace App\Repositories;

use App\Models\Category;

class CategoryRepository {
    public function all() {
        return Category::with('products')->get();
    }

    public function create(array $data) {
        return Category::create($data);
    }

    public function delete($id) {
        return Category::findOrFail($id)->delete();
    }

    public function find($id) {
        return Category::with('products')->findOrFail($id);
    }
}
