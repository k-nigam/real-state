php artisan config:clear
php artisan cache:clear


php artisan migrate
This will create Laravel's default tables, including:


php artisan db:show



Difference from other commands
Command	Purpose
php artisan about	                    Inspect Laravel configuration
php artisan migrate	                    Create/update database tables
php artisan migrate:status	            See migration status
php artisan config:clear	            Clear configuration cache
php artisan cache:clear	                Clear application cache
php artisan storage:link	            Create storage symlink
php artisan serve	                    Start Laravel development server