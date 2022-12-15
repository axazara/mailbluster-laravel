# Products
To learn more about the API, visit [MailBluster API - Products](https://app.mailbluster.com/api-doc/products)

## Get all products

```php
MailBluster::getProducts();
```

If request is successful, this method return object containing `products` property which is an array of products and `meta` property which is an object containing pagination information.
Otherwise, it return `null` and you can get the error message by calling `getLastError()` method.

## Get a product

```php
MailBluster::getProduct(string $id);
```

- `$id` - ID of the product

If request is successful, this method return object containing product details.
Otherwise, it returns `null` and you can get the error message by calling `getLastError()` method.

## Create a product

```php
MailBluster::createProduct(string $id, string $name);
```

- `$id` - ID of the product, must be unique
- `$name` - Name of the product

If request is successful, this method return object containing product details.
Otherwise, it returns `null` and you can get the error message by calling `getLastError()` method.

## Update a product 

```php
MailBluster::updateProduct(string $id, string $name);
```

- `$id` - ID of the product, must be unique
- `$name` - Name of the product

If request is successful, this method return object containing product details.
Otherwise, it returns `null` and you can get the error message by calling `getLastError()` method.

## Delete a product

```php
MailBluster::deleteProduct(string $id);
```

- `$id` - ID of the product

If request is successful, this method return `true`, otherwise it return `false` and you can get the error message by calling `getLastError()` method.
