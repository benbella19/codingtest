<?php

namespace Tests\Feature;

use App\Services\ProductService;
use App\Repositories\ProductRepository;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductServiceTest extends TestCase
{
    use RefreshDatabase; 

    protected $productService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->productRepo = new ProductRepository();
        $this->productService = new ProductService($this->productRepo);
    }

    /**
     * Test the creation of a product.
     *
     * @return void
     */
    public function testCreateProduct()
    {
        $data = [
            'name' => 'Test Product',
            'description' => 'This is a test product.',
            'price' => 49.99,
            'image' => null, 
            'category_id' => 1, 
        ];

        $product = $this->productService->createProduct($data);

        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'description' => 'This is a test product.',
            'price' => 49.99,
            'category_id' => 1,
        ]);
        $this->assertInstanceOf(Product::class, $product);
    }
}
