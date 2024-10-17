# codingtest

1. Clone the repository
2. Run `composer install` for Laravel dependencies
3. Run `npm install` for React dependencies
4. Set up the database and run migrations

# commands
php artisan test --filter ProductServiceTest
php artisan product:manage create hoodie --description="A description" --price=99.99 --image="image_link" --category_id=1
php artisan product:manage delete "product Name" --id=1
php artisan category:manage create "Category Name" --parent=1
php artisan category:manage delete "Category Name" --id=1

