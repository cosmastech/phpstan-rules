<?php

declare(strict_types=1);

namespace Ergebnis\PHPStan\Rules\Test\Fixture\Methods\NoParameterWithNullDefaultValueRule;

trait MethodInTraitWithParameterWithWronlgyCapitalizedNullDefaultValue
{
    public function foo($bar = NuLl)
    {
        return $bar;
    }
}
