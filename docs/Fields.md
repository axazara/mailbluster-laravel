# Fields
To learn more about the API, visit [MailBluster API - Fields](https://app.mailbluster.com/api-doc/fields)

## Get all fields

```php
Mailify::getFields();
```

If request is successful, this method return object containing all fields in array.
Otherwise, it returns `null` and you can get the error message by calling `getLastError()` method.

## Create a field

```php
Mailify::createField(string $label, string $tag);
```

- `$label` - Label of the field
- `$tag` - Tag of the field

If request is successful, this method return object containing field details.
Otherwise, it returns `null` and you can get the error message by calling `getLastError()` method.

## Update a field

```php
Mailify::updateField(string $id, string $label, string $tag);
```

- `$id` - ID of the field
- `$label` - Label of the field
- `$tag` - Tag of the field

If request is successful, this method return object containing field details.
Otherwise, it returns `null` and you can get the error message by calling `getLastError()` method.


## Delete a field

```php
Mailify::deleteField(string $id);
```

- `$id` - ID of the field

If request is successful, this method return `true`, otherwise it return `false` and you can get the error message by calling `getLastError()` method.