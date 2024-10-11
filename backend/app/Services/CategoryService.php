<?php
namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService {
    protected $categoryRepo;

    public function __construct(CategoryRepository $categoryRepo) {
        $this->categoryRepo = $categoryRepo;
    }

    public function createCategory(array $data) {
        return $this->categoryRepo->create($data);
    }

    public function deleteCategory($id) {
        return $this->categoryRepo->delete($id);
    }

    public function listCategories() {
        return $this->categoryRepo->all();
    }
}
