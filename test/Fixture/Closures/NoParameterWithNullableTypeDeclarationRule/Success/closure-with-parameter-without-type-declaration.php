<?php

declare(strict_types=1);

namespace Localheinz\PHPStan\Rules\Test\Fixture\Closures\NoParameterWithNullDefaultValueRule\Success;

$foo = function ($bar) {
    return $bar;
};
