<?php

declare(strict_types=1);

namespace Ergebnis\PHPStan\Rules\Test\Fixture\Methods\NoParameterWithNullDefaultValueRule\Failure;

interface MethodInInterfaceWithParameterWithRootNamespaceReferencedNullDefaultValue
{
    public function foo($bar = \null);
}
