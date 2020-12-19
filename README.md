# TypeEx

A collection of useful behavior extensions for PHP

[![github.com](https://github.com/modethirteen/TypeEx/workflows/build/badge.svg)](https://github.com/modethirteen/TypeEx/actions?query=workflow%3Abuild)
[![codecov.io](https://codecov.io/github/modethirteen/TypeEx/coverage.svg?branch=main)](https://codecov.io/github/modethirteen/TypeEx?branch=main)
[![Latest Stable Version](https://poser.pugx.org/modethirteen/type-ex/version.svg)](https://packagist.org/packages/modethirteen/type-ex)
[![Latest Unstable Version](https://poser.pugx.org/modethirteen/type-ex/v/unstable)](https://packagist.org/packages/modethirteen/type-ex)

## Requirements

* PHP 7.2, 7.3, 7.4 (1.x)
* PHP 7.4 (main)

## Installation

Use [Composer](https://getcomposer.org/). There are two ways to add TypeEx to your project.

From the composer CLI:

```sh
./composer.phar require modethirteen/type-ex
```

Or add modethirteen/type-ex to your project's composer.json:

```json
{
    "require": {
        "modethirteen/type-ex": "dev-main"
    }
}
```

`dev-main` is the main development branch. If you are using TypeEx in a production environment, it is advised that you use a stable release.

Assuming you have setup Composer's autoloader, TypeEx can be found in the `modethirteen\TypeEx\` namespace.

## Usage

### Dictionary

```php
// a collection builder with optional validation of set values (type checks, etc.)
$dictionary = new Dictionary(function($value) : bool {

    // enforce a collection of integer values only
    return is_int($value);
});
$dictionary->set('foo', 123);
$dictionary->set('bar', 'xyzzy'); // throws InvalidDictionaryValueException

// dictionaries are iterable
foreach($dictionary as $key => value) { }

// ...and the underlying array data structure is accessible
$dictionary->toArray(); // ['foo' => 123]
```

### StringDictionary

```php
// a collection builder that leverages PHP-native type checking to enforce string types only
$dictionary = new StringDictionary();
$dictionary->set('bar', 'xyzzy');

// string dictionaries are iterable
foreach($dictionary as $key => value) { }

// ...and the underlying array data structure is accessible
$dictionary->toArray(); // ['foo' => 'xyzzy']
```

### StringEx

```php
// check for empty strings with strict type checking
StringEx::isNullOrEmpty(null); // true
StringEx::isNullOrEmpty(''); // true
StringEx::isNullOrEmpty('foo'); // false

// convert any value to a string, with some slightly different rules than strval(...)
StringEx::stringify(null); // ''
StringEx::stringify('foo'); // 'foo'
StringEx::stringify(true); // 'true'
StringEx::stringify(false); // 'false'
StringEx::stringify(123); // '123'

// array values are serialized to comma-separated lists
StringEx::stringify(['foo', 'bar']); // 'foo,bar'
StringEx::stringify(['foo', 'plugh', 'bar' => ['baz']]); // 'foo,plugh,baz'

// the value of anonymous functions are stringified
StringEx::stringify(function() { return 'foo'; }); // 'foo'
StringEx::stringify(function() { return 123; }); // '123'
StringEx::stringify(function() { return ['foo', 'bar']; }); // 'foo,bar'
StringEx::stringify(function() { return ['foo', 'plugh', 'bar' => ['baz']]; }); // 'foo,plugh,baz'

// objects, as expected, have __toString called (even objects returned from anonymous functions)
StringEx::stringify(function() { return new class { function __toString() : string { return 'xyzzy'; }}; }); // 'xyzzy'
StringEx::stringify(new class { function __toString() : string { return 'qux'; }}); // 'qux'

// check if a string contains a sub-string value
(new StringEx('foo bar'))->contains('foo'); // true
(new StringEx('baz'))->contains('foo'); // false

// check if a string ends with a sub-string value
(new StringEx('foo bar'))->endsWith('bar'); // true
(new StringEx('foo bar'))->endsWith('qux'); // false
(new StringEx('foo bar'))->endsWithInvariantCase('BAR'); // true

// check if a string starts with a sub-string value
(new StringEx('foo bar'))->startsWith('foo'); // true
(new StringEx('foo bar'))->startsWith('qux'); // false
(new StringEx('foo bar'))->startsWithInvariantCase('FOO'); // true

// an immutable string manipulation API for removing, trimming, and templating
$replacements = new StringDictionary();
$replacements->set('bar', 'frank');
$replacements->set('qux', 'jesse');
$string = (new StringEx('foo {{bar}} baz {{qux}} plugh xyzzy'))
    ->removePrefix('foo')
    ->trim()
    ->template($replacements);

// trimming and adding ellipsis attempts to break on words    
$string->ellipsis(20)->toString(); // 'frank baz jesse …'
$string->ellipsis(25)->toString(); // 'frank baz jesse plugh …'
```

### BoolEx

```php
// convert any value to a boolean, with some slightly different rules than boolval(...)
BoolEx::boolify(true); // true
BoolEx::boolify(false); // false

// strings are literally checked for the word "true" in order to return a true value
BoolEx::boolify(null); // false
BoolEx::boolify('foo'); // false
BoolEx::boolify(function() { return null; }); // false
BoolEx::boolify(function() { return 'foo'; }); // false
BoolEx::boolify(new class { function __toString() : string { return 'true'; }}); // true
BoolEx::boolify(new class { function __toString() : string { return 'false'; }}); // false
BoolEx::boolify(function() { return new class { function __toString() : string { return 'true'; }}; }); // true
BoolEx::boolify(function() { return new class { function __toString() : string { return 'false'; }}; }); // false

// any numeric above 0, or any string that appears to be numeric above 0, is true
BoolEx::boolify(function() { return 123; }); // true
BoolEx::boolify(123); // true
BoolEx::boolify('123'); // true
BoolEx::boolify('-5'); // false
BoolEx::boolify('0.1'); // true
BoolEx::boolify('0'); // false
BoolEx::boolify('0.0'); // false
 
// arrays, or functions and objects that return arrays, are the same behavior as boolval(...): if the collection is empty the value is false
BoolEx::boolify(function() { return ['foo', 'bar']; }); // true
BoolEx::boolify(function() { return ['foo', 'plugh', 'bar' => ['baz']]; }); // true
BoolEx::boolify(['foo', 'bar']); // true
BoolEx::boolify(['foo', 'plugh', 'bar' => ['baz']]); // true
BoolEx::boolify([]); // false
BoolEx::boolify(['foo' => []]); // true
```
