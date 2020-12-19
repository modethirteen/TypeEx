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
