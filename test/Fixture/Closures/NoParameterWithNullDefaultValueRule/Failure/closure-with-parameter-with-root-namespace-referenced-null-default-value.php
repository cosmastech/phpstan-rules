<?php

declare(strict_types=1);

namespace Ergebnis\PHPStan\Rules\Test\Fixture\Closures\NoParameterWithNullDefaultValueRule\Success;

$foo = function ($bar = null) {
    return $bar;
};
