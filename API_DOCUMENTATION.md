# POS System API Documentation

## Base URL
```
http://127.0.0.1:8000/api   // on Local Host
https://zafarcomputers.com/api  // on Web host
```

## Authentication
All protected routes require Bearer token in header:
```
Authorization: Bearer {token}
```

---

## 🔐 Authentication APIs

### 1. Register User
```http
POST /register
```

**Request Body:**
```json
{
    "first_name": "John",
    "last_name": "Doe", 
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "cell_no1": "1234567890",
    "cell_no2": "0987654321"
}
```

**Response:**
```json
{
    "message": "User registered successfully",
    "token": "1|laravel_sanctum_token...",
    "user": {
        "id": 1,
        "first_name": "John",
        "last_name": "Doe",
        "email": "john@example.com",
        "role_id": 1
    }
}
```

### 2. Login
```http
POST /login
```

**Request Body:**
```json
{
    "email": "john@example.com",
    "password": "password123"
}
```

**Response:**
```json
{
    "token": "1|laravel_sanctum_token...",
    "user": {
        "id": 1,
        "first_name": "John",
        "last_name": "Doe",
        "full_name": "John Doe",
        "email": "john@example.com",
        "cell_no1": "1234567890",
        "role": {
            "id": 1,
            "name": "admin"
        }
    }
}
```

### 3. Get Profile
```http
GET /profile
Headers: Authorization: Bearer {token}
```

### 4. Update Profile
```http
PUT /update-profile
Headers: Authorization: Bearer {token}
```

**Request Body:**
```json
{
    "first_name": "John Updated",
    "last_name": "Doe Updated",
    "cell_no1": "1111111111"
}
```

### 5. Change Password
```http
POST /change-password
Headers: Authorization: Bearer {token}
```

**Request Body:**
```json
{
    "current_password": "oldpassword",
    "new_password": "newpassword123",
    "new_password_confirmation": "newpassword123"
}
```

### 6. Refresh Token
```http
POST /refresh-token
Headers: Authorization: Bearer {token}
```

### 7. Logout
```http
POST /logout
Headers: Authorization: Bearer {token}
```

---

## 🛍️ POS Cart Management APIs

### 1. Get Cart
```http
GET /pos-cart
Headers: Authorization: Bearer {token}
```

**Response:**
```json
{
    "success": true,
    "message": "Cart retrieved successfully",
    "data": {
        "items": [
            {
                "product_id": 1,
                "product": {
                    "id": 1,
                    "name": "Product Name",
                    "sale_price": 100.00,
                    "stock": 50
                },
                "quantity": 2,
                "unit_price": 100.00,
                "total_price": 200.00
            }
        ],
        "total_amount": 200.00,
        "total_items": 1
    }
}
```

### 2. Add to Cart
```http
POST /pos-cart/add
Headers: Authorization: Bearer {token}
```

**Request Body:**
```json
{
    "product_id": 1,
    "quantity": 2
}
```

### 3. Update Cart Item
```http
PUT /pos-cart/{productId}
Headers: Authorization: Bearer {token}
```

**Request Body:**
```json
{
    "quantity": 3
}
```

### 4. Remove from Cart
```http
DELETE /pos-cart/{productId}
Headers: Authorization: Bearer {token}
```

### 5. Clear Cart
```http
DELETE /pos-cart
Headers: Authorization: Bearer {token}
```

### 6. Apply Discount
```http
POST /pos-cart/discount
Headers: Authorization: Bearer {token}
```

**Request Body:**
```json
{
    "discount_type": "percentage", // or "fixed"
    "discount_value": 10.5
}
```

---

## 📦 Product APIs

### 1. Get All Products
```http
GET /products
Headers: Authorization: Bearer {token}
```

### 2. Get Single Product
```http
GET /products/{id}
Headers: Authorization: Bearer {token}
```

### 3. Create Product
```http
POST /products
Headers: Authorization: Bearer {token}
```

### 4. Update Product
```http
PUT /products/{id}
Headers: Authorization: Bearer {token}
```

### 5. Delete Product
```http
DELETE /products/{id}
Headers: Authorization: Bearer {token}
```

### 6. Get Low Stock Products
```http
GET /products/low-stock
Headers: Authorization: Bearer {token}
```

---

## 👥 User Management APIs

### 1. Get Users by Role
```http
GET /users-by-role/{roleName}
Headers: Authorization: Bearer {token}
Required Roles: admin, manager
```

### 2. CRUD Operations for Users
```http
GET /users          # List all users
POST /users         # Create user  
GET /users/{id}     # Get single user
PUT /users/{id}     # Update user
DELETE /users/{id}  # Delete user
Headers: Authorization: Bearer {token}
```

---

## 🏪 POS Sales APIs

### 1. Get All Sales/Invoices
```http
GET /pos
Headers: Authorization: Bearer {token}
```

### 2. Create Sale/Invoice
```http
POST /pos
Headers: Authorization: Bearer {token}
```

**Request Body:**
```json
{
    "customer_id": 1,
    "total_amount": 500.00,
    "paid_amount": 500.00,
    "discount": 0,
    "tax": 50.00,
    "items": [
        {
            "product_id": 1,
            "quantity": 2,
            "unit_price": 100.00,
            "total_price": 200.00
        }
    ]
}
```

### 3. Get Single Sale/Invoice
```http
GET /pos/{id}
Headers: Authorization: Bearer {token}
```

### 4. Update Sale/Invoice
```http
PUT /pos/{id}
Headers: Authorization: Bearer {token}
```

### 5. Delete Sale/Invoice
```http
DELETE /pos/{id}
Headers: Authorization: Bearer {token}
```

---

## 📊 Reporting APIs

### 1. Sales Report
```http
GET /salesRep
Headers: Authorization: Bearer {token}
Query Parameters: ?from_date=2024-01-01&to_date=2024-12-31
```

### 2. Best Selling Products
```http
GET /reports/best-selling-products
Headers: Authorization: Bearer {token}
```

### 3. Inventory Report
```http
GET /InvtoryReport
Headers: Authorization: Bearer {token}
```

### 4. Purchase Report
```http
GET /purReport
Headers: Authorization: Bearer {token}
```

---

## 📋 Master Data APIs

### Categories
```http
GET /categories       # List categories
POST /categories      # Create category
GET /categories/{id}  # Get category
PUT /categories/{id}  # Update category
DELETE /categories/{id} # Delete category
Headers: Authorization: Bearer {token}
```

### Customers  
```http
GET /customers        # List customers
POST /customers       # Create customer
GET /customers/{id}   # Get customer
PUT /customers/{id}   # Update customer
DELETE /customers/{id} # Delete customer
Headers: Authorization: Bearer {token}
```

### Vendors
```http
GET /vendors         # List vendors
POST /vendors        # Create vendor  
GET /vendors/{id}    # Get vendor
PUT /vendors/{id}    # Update vendor
DELETE /vendors/{id} # Delete vendor
Headers: Authorization: Bearer {token}
```

---

## 🔒 Role-Based Access Control

### Available Roles:
- `admin` - Full access
- `manager` - Management access
- `cashier` - POS operations only
- `inventory` - Inventory management

### Usage:
Add middleware to routes:
```php
Route::middleware(['auth:sanctum', 'role:admin,manager'])->group(function () {
    // Protected routes
});
```

---

## 📱 Flutter Integration Examples

### 1. Login Implementation
```dart
Future<Map<String, dynamic>> login(String email, String password) async {
  final response = await http.post(
    Uri.parse('$baseUrl/login'),
    headers: {'Content-Type': 'application/json'},
    body: jsonEncode({
      'email': email,
      'password': password,
    }),
  );
  
  if (response.statusCode == 200) {
    final data = jsonDecode(response.body);
    // Store token in secure storage
    await storage.write(key: 'auth_token', value: data['token']);
    return data;
  } else {
    throw Exception('Login failed');
  }
}
```

### 2. Authenticated Request
```dart
Future<List<Product>> getProducts() async {
  final token = await storage.read(key: 'auth_token');
  
  final response = await http.get(
    Uri.parse('$baseUrl/products'),
    headers: {
      'Content-Type': 'application/json',
      'Authorization': 'Bearer $token',
    },
  );
  
  if (response.statusCode == 200) {
    final data = jsonDecode(response.body);
    return (data['data'] as List)
        .map((item) => Product.fromJson(item))
        .toList();
  } else {
    throw Exception('Failed to load products');
  }
}
```

---

## ⚡ Error Responses

### Standard Error Format:
```json
{
    "success": false,
    "message": "Error message",
    "errors": {
        "field": ["Specific field error"]
    }
}
```

### Common HTTP Status Codes:
- `200` - Success
- `201` - Created
- `400` - Bad Request
- `401` - Unauthorized
- `403` - Forbidden
- `404` - Not Found
- `422` - Validation Error
- `500` - Server Error

---

## 🚀 Testing

### Using Postman/Insomnia:
1. Set base URL: `http://your-domain.com/api`
2. Login to get token
3. Add token to Authorization header for protected routes
4. Test all endpoints

### Using curl:
```bash
# Login
curl -X POST http://your-domain.com/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"admin@example.com","password":"password"}'

# Get products (with token)
curl -X GET http://your-domain.com/api/products \
  -H "Authorization: Bearer your-token-here"
```