Apply sorting of [`vuetable-2`](https://github.com/ratiw/vuetable-2) on Laravel Eloquent queries.

## Version

Current release: **v1.2.0**

This repository uses [Semantic Versioning (SemVer) v2.0.0](http://semver.org/spec/v2.0.0.html).

## Installation

Pull this package in through Composer.

```
composer require riesjart/laravel-vue-table-sorting "~1.0"
```

## Usage

Apply the trait to any of the models you would like to enable sorting on.

*Example*:

```
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Riesjart\VueTable\Traits\VueTableSortable;

class ExampleModal extends Model
{
    use VueTableSortable;
}

```

After that, add the `orderByVueTable` scope when retrieving your model:

*Example*:
```
public function example()
{
    return ExampleModal::orderByVueTable()->paginate();
}
```
