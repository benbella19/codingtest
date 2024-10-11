<?php
namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService {
    protected $productRepo;

    public function __construct(ProductRepository $productRepo) {
        $this->productRepo = $productRepo;
    }

    public function createProduct(array $data) {

        return $this->productRepo->create($data);
    }

    public function deleteProduct($id) {
        return $this->productRepo->delete($id);
    }

    public function listProducts($sortBy = 'name') {
        return $this->productRepo->all($sortBy);
    }
}
