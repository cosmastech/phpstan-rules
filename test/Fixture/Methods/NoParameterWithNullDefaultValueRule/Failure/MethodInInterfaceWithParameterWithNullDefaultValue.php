<?php

declare(strict_types=1);

namespace Localheinz\PHPStan\Rules\Test\Fixture\Methods\NoParameterWithNullDefaultValueRule\Failure;

interface MethodInInterfaceWithParameterWithNullDefaultValue
{
    public function foo($bar = null);
}
