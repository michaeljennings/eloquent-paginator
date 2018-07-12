# Eloquent Paginator

Eloquent is awesome, but occasionally I hit into an issue with paginating with having clauses.

This package adds a new method to the eloquent builder that retains the select statements while paginating.

[Example of the bug](https://github.com/laravel/framework/pull/5515)

## Installation

Install through composer using `composer require michaeljennings/eloquent-paginator` or add the package to the require section of your `composer.json` file.

```
"require": {
	...
	"michaeljennings/eloquent-paginator": "^1.0"
}
```

Then run `composer update` to install the package.

## Usage

Instead of using `paginate` use `paginateWithSelects` instead.

```php
$query->paginate(15);
$query->paginateWithSelects(15);
```

As the we retain the select queries from the query you cannot specify the columns like you can with the standard `paginate` method. 

However you can still specify the paginator name and the currency page if needed.

```php
$query->paginateWithSelects(15, 'foo', 2);
```