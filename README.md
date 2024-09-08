# Create Read Update Delete (CRUD) Action

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lakasir/has-crud-action.svg?style=flat-square)](https://packagist.org/packages/lakasir/has-crud-action)
[![Total Downloads](https://img.shields.io/packagist/dt/lakasir/has-crud-action.svg?style=flat-square)](https://packagist.org/packages/lakasir/has-crud-action)
![GitHub Actions](https://github.com/lakasir/has-crud-action/actions/workflows/main.yml/badge.svg)

`has-crud-action` is a GitHub Action designed to streamline CRUD (Create, Read, Update, Delete) operations for your projects. This action simplifies and automates workflows for managing data entities within your repository or connected services.

## Features

* **CRUD** - easily create, read, update, and delete data entities.
* **Rules** - you can add the rules for your CRUD actions on the fly.
* **Magic Parameters** - use magic parameters to create CRUD actions.

## Getting Started

### Installation

You can install the package via composer:

```bash
composer require lakasir/has-crud-action
```

### Usage

```php
// in your routes file
Route::resource('suppliers', SupplierController::class);

// in your controller file
use Lakasir\HasCrudAction\Abstracts\HasCrudActionAbstract;
use App\Models\Supplier;

class SupplierController extends HasCrudActionAbstract
{
    public static string $model = Supplier::class;
}
```

### Methods
`rules` the rules method allows you to add your own rules to the action.
```
public static function rules(): array
{
    return [
        'phone_number' => 'unique:suppliers,phone_number',
        'name' => 'required'
    ];
}
```

`beforeStore` the beforeStore method allows you to modify the data before it is stored.
```
public static function beforeStore($data, $model): Model
{
    $model->name = strtoupper($data['name']);

    return $model;
}
```

`beforeUpdate` the beforeUpdate method allows you to modify the data before it is updated.
```
public static function beforeUpdate($data, $model): Model
{
    $model->name = strtoupper($data['name']);

    return $model;
}
```

`response` the response method allows you to modify the response data.
```
public static function response($record)
{
    return [
        'data' => $record,
        'success' => true,
    ];
}
```

### Magic Parameters

* $id - The ID of the record
* $method - The HTTP method (GET, POST, PUT, PATCH, DELETE)
* $model - The model class name
* $data - The data sent from the request
* $record - The record object associated with the action
* $action - The current method action name
* $route - The current route name


### Testing

```bash
composer test
```

### Todo

* [ ] Pagination support
* [ ] Filter support
* [ ] ModifyQuery
* [ ] Error handler for unsupported magic parameter
* [ ] Relation support

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

### Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email lakasirapp@gmail.com instead of using the issue tracker.

### Credits

-   [lakasir](https://github.com/lakasir)
-   [All Contributors](../../contributors)

### License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

### Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
