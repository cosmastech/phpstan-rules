<?php

declare(strict_types=1);

namespace Ergebnis\PHPStan\Rules\Test\Fixture\Methods\NoParameterWithNullDefaultValueRule;

final class MethodInClassWithParameterWithWronglyCapitalizedNullDefaultValue
{
    public function foo($bar = NuLl)
    {
        return $bar;
    }
}
