<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CategoryService;

class ManageCategory extends Command {
    protected $signature = 'category:manage {action} {name} {--parent=} {--id=}';
    protected $description = 'Create or delete a category';
    protected $categoryService;

    public function __construct(CategoryService $categoryService) {
        parent::__construct();
        $this->categoryService = $categoryService;
    }

    public function handle() {
        $action = $this->argument('action');
        $name = $this->argument('name');
        $id = $this->option('id'); 
        $parent = $this->option('parent');

        try {
            if ($action === 'create') {
                $this->categoryService->createCategory([
                    'name' => $name,
                    'parent_id' => $parent
                ]);
                $this->info('Category created successfully!');
            } elseif ($action === 'delete') {
                if ($id) {
                    $this->categoryService->deleteCategory($id);
                    $this->info('Category deleted successfully!');
                } else {
                    $this->error('Please provide an ID to delete the category.');
                }
            }
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
        }
    }
}
