# Autoinspector PHP SDK

The Autoinspector PHP library provides convenient access to the Autoinspector API from
applications written in the PHP language. It includes a pre-defined set of
classes for API resources that initialize themselves dynamically.

## Requirements

PHP 5.6.0 and later.

## Composer

You can install the bindings via [Composer](http://getcomposer.org/). Run the following command:

```bash
composer require autoinspector/autoinspector-php
```

To use the bindings, use Composer's [autoload](https://getcomposer.org/doc/01-basic-usage.md#autoloading):

```php
require_once('vendor/autoload.php');
```

## Dependencies

The bindings require the following extensions in order to work properly:

- [`guzzle`](https://secure.php.net/manual/en/book.curl.php)

If you use Composer, these dependencies should be handled automatically. If you install manually, you'll want to make sure that these extensions are available.

## Getting Started

Simple usage looks like:

```php

//If you only want to use OAuth 2.0 methods, just pass an empty array to the constructor:
// new \Autoinspector\AutoinspectorClient([])

$autoinspector = new \Autoinspector\AutoinspectorClient('YOU_API_KEY_GOES_HERE');

$inspection = $autoinspector->inspections->car->create([
'delivery' => [
    'channel' => 'wsp',
    'destination' => '3813635420',
    'disabled' => false,
],
'locale' => 'es_AR',
'consumer' => [
    'firstName' => 'Luciano',
    'lastName' => 'Alvarez',
    'email' => 'lucianoalvarez1212@gmail.com',
    'identification' => '3213232',
],
'inputs' => [
    [
        "identifier" => "input_25dd4378-395d-4fe6-8306-65dcead884b0",
        "value" => "POLIZA A"
    ],
],
'car' => [
    'plate' => 'AB705SU',
    'year' => 2020
],
'templateId' => "6275b69764cef10044676dc5",
'producer'  => [
    'internalId' => '123'
],
'initialStatus' => 'started'
]);

print_r($inspection, false);
```

## Documentation

See the [PHP API docs](https://autoinspector.com.ar/docs/api/start?lang=php). (You must have an account in order to be able to read the docs)
