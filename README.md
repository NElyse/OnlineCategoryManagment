# Online Store API

This is an API for managing categories in an online store. It is built using Laravel and MySQL.

## Prerequisites

- PHP 7.4 or higher
- Composer
- MySQL
- Laravel 8

 ## Configure the database connection:

- Create a new MySQL database for the project
- In `.env` file and update the following lines with your database credentials:
                        DB_CONNECTION=mysql
                        DB_HOST=127.0.0.1
                        DB_PORT=3306
                        DB_DATABASE=online_store
                        DB_USERNAME=root
                        DB_PASSWORD=
 
## Start the local development server:

- php artisan serve
- The API will be available on `http://127.0.0.1:8000`.

## API Endpoints

- GET /categories: Retrieve all categories in XML format.
- GET /categories/{id}: Retrieve a specific category by its ID in XML format.
- POST /categories: Create a new category.
- PUT /categories/{id}: Update an existing category by its ID. 
- DELETE /categories/{id}: Delete a category by its ID.




## Testing
- php artisan make:test CategoryTest
- To run the unit tests, execute the following command 
- "php artisan test":



