<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ProductService;

class ManageProduct extends Command {
    protected $signature = 'product:manage {action} {name} {--description=} {--price=} {--image=} {--category_id=} {--id=}';
    protected $description = 'Create or delete a product';
    protected $productService;

    public function __construct(ProductService $productService) {
        parent::__construct();
        $this->productService = $productService;
    }

    public function handle() {
        $action = $this->argument('action');
        $name = $this->argument('name');
        $description = $this->option('description');  
        $price = $this->option('price');  
        $image = $this->option('image');  
        $category_id = $this->option('category_id');  
        $id = $this->option('id');  

        try {
            if ($action === 'create') {
                $data = [
                    'name' => $name,
                    'description' => $description,
                    'price' => $price,
                    'image' => $image,
                    'category_id' => $category_id,
                ];
                $this->productService->createProduct($data);
                $this->info('Product created successfully!');
            } elseif ($action === 'delete') {
                if ($id) {
                    $this->productService->deleteProduct($id);
                    $this->info('Product deleted successfully!');
                } else {
                    $this->error('Please provide an ID to delete the product.');
                }
            } else {
                $this->error('Invalid action. Use "create" or "delete".');
            }
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
        }
    }
}
