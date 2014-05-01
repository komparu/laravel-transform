### Composer setup

In the `require` key of `composer.json` file add the following
```json
"connorvg/php-wtf": "dev-master"
```

Run the Composer update command
```bash
$ composer update
```

_OR_

You can run the command `composer require connorvg/laravel-transform` from the command line interface.

### Laravel

If you're using laravel, add this service provider:
```php
'ConnorVG\Transform\TransformServiceProvider'
```

Also, this Facade:
```php
'Transform' => 'ConnorVG\Transform\TransformFacade'
```

### Usage

**Transform** is a very simple package once you get the hang of it, I'll break it down as much as I can here:

The only function **Transform** actually has is
```php
::make(
Array or something with ->toArray() as input,
Array of definitions,
Array of aliases *optional*
);
```

## Input

Input can be anything that is an array or an object with a method 'toArray()' which returns an array. You can also have meta-arrays (multidimensional arrays) and the framework will figure this out for you.

EG:
```php
[
    'this'  => 'that',
    'hey'   => 'bye',
    'more'  => [
        'go' => 'where?'
        'to' => 'there!'
    ]
]
```

## Definitions

Definitions are used to define types, this will cast values to types where required.

EG:

# Input
```php
$input = [
    'some_number' => '18',
    'a_bool'      => '0',
    'more_stuff'  => [
        'yeah' => '1'
    ]
]
```

# Definitions

Definitions are used to define a value as a type, this actually sets the object type (IE: from `'5'` to `5`).

```php
$defs = [
    'some_number' => 'int',
    'a_bool'      => 'bool',
    'more_stuff'  => [
        'yeah' => 'bool'
    ]
]
```

These, used as: `Transform::make($input, $defs);` will output:
```php
[
    'some_number' => 18,
    'a_bool'      => false,
    'more_stuff'  => [
        'yeah' => true
    ]
]
```

You can also define iteratively for arrays of objects (arrays), so this:
```php
$input = [
    [ 'id' => '1', 'active' => '1' ],
    [ 'id' => '2', 'active' => '0' ],
    [ 'id' => '3', 'active' => '1' ]
]
```

Can be defined using the index of 0, this is what is used to find iterative definitions:
```php
$defs = [
    [ 'id' => 'int', 'active' => 'bool' ]
]
```

These, used as: `Transform::make($input, $defs);` will output:
```php
[
    [ 'id' => 1, 'active' => true ],
    [ 'id' => 2, 'active' => false ],
    [ 'id' => 3, 'active' => true ]
]
```

*NOTE: These types of definitions CAN be used together*

# Aliases

Aliases are ways of hiding are renaming fields, this is great for API usage. To hide a value just set it's alias to `null`.

```php
$input = [
    [ 'id' => '1', 'active' => '1', 'password' => 'some_pass' ],
    [ 'id' => '2', 'active' => '0', 'password' => 'some_pass' ],
    [ 'id' => '3', 'active' => '1', 'password' => 'some_pass' ],

    'count' => '3'
]
```

You may alias these as so:
```php
$aliases = [
    [ 'active' => 'alive', 'password' => null ],

    'count' => 'amount'
]
```

These, used as: `Transform::make($input, [], $aliases);` will output:
```php
[
    [ 'id' => '1', 'alive' => '1' ],
    [ 'id' => '2', 'alive' => '0' ],
    [ 'id' => '3', 'alive' => '1' ],

    'amount' => '3'
]
```

To rename an array, it's simple. Either just do it as a variable (if you wish to leave it's contents alone, or set it to `[ NEW_NAME, [ CONTENTS_ALIASES ] ]`, if `NEW_NAME` is null, it wont change the name of the array.

```php
[
    'test' => [
        'this' => 'that'
    ]
]
```

With this alias array:
```php
[
    'test' => [ null, [
        'this' => 'nope'
    ]]
]
```

Will output:
```php
[
    'test' => [
        'nope' => 'this'
    ]
]
```

Don't be afraid to nest, full nesting is available because every array is treated as a root.
