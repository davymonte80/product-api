# Product API

Welcome to the Product API! This intuitive API allows you to manage products with ease — from listing and searching to creating, updating, and deleting products. Whether you're a developer looking to integrate product management into your app or just exploring, this guide will walk you through installation, setup, and how to navigate the API effectively.

---

## Installation

### Requirements
- PHP (compatible with Laravel 12.x)
- Composer (PHP dependency manager)
- SQLite or another supported database (this project uses SQLite by default)

### Steps

1. **Clone the repository:**
   ```bash
   git clone [https://github.com/davymonte80/product-api.git]
   cd product-api
   ```

2. **Install dependencies:**
   ```bash
   composer install
   ```

3. **Set up environment:**
   - Copy the example environment file and configure it:
     ```bash
     cp .env.example .env
     ```
   - Adjust database settings in `.env`(default uses SQLite).

4. **Generate application key:**
   ```bash
   php artisan key:generate
   ```

5. **Run database migrations:**
   ```bash
   php artisan migrate
   ```

---

## Running the API Server

Start the Laravel development server with:

```bash
php artisan serve
```

The server will run at `http://127.0.0.1:8000`.

---

## Authentication & Authorization

- Some endpoints require authentication via Laravel Sanctum.
- Public endpoints (no auth required):  
  - List all products  
  - View a single product  
  - Search products by name
- Protected endpoints:
  - Create a product  
  - Update a product 
  - Delete a product 

---

## API Endpoints

### List Products

- **GET** `/api/products`  
- Returns a list of all products.

### View Product Details

- **GET** `/api/products/{id}`  
- Returns details of a specific product by ID.

### Search Products

- **GET** `/api/products/search?name={query}`  
- Search products by name (partial matches supported).

### Create a Product

- **POST** `/api/products`  
- Requires authentication.  
- Request body example:
  ```json
  {
    "name": "New Product",
    "description": "Product description",
    "price": 19.99
  }
  ```

### Update a Product

- **PUT/PATCH** `/api/products/{id}`  
- Requires authentication and ownership.  
- Request body example (any subset of fields):
  ```json
  {
    "name": "Updated Product Name"
  }
  ```

### Delete a Product

- **DELETE** `/api/products/{id}`  
- Requires authentication and ownership.

---

## Navigating the API

1. **Get an authentication token** (not covered here, but typically via Laravel Sanctum login).
2. **Use the token** in the `Authorization` header as a Bearer token for protected routes.
3. **Explore public endpoints** freely without authentication.
4. **Create, update, and delete** products only if authenticated and authorized.

---

## Additional Notes

- The product model includes fields: `name`, `description`, `price`, and `user_id` (owner).
- Validation is enforced on create and update requests.
- Authorization policies ensure only owners can modify or delete their products.
