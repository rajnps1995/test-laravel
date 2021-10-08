Step 1:- Clone The Project
Step 2:- Create .env file by typing 'cp .env.example .env' and declare database name file before migrating.
Step 3:- Generate artisan key by typing 'php artisan key:generate' in your terminal.
Step 4:- Install & Update composer by typing 'composer install & composer update' in your terminal.
Step 5:- To Migrate Use:-
php artisan migrate
Step 6:- To seed for fake data insert type:-
php artisan db:seed
Step 7:- Mail is being sent to the super admin on every product upload with all details as per the task at applocumadmin@yopmail.com.
Step 8:- Kindly declare your SMTP mail port & credentials for the mail process.
Step 9:- To check routes here for CRUD operations of Product & Category Route::Resource concept hat been used so type php artisan route:list in the terminal to see all the routes.
Step 10:- After logging in fake seeder data on the dashboard home page you can find Category & Product Section where both are listed. or login Auth:login has been used.
Step 11:- To run locally type 'php artisan serve' in your terminal.
