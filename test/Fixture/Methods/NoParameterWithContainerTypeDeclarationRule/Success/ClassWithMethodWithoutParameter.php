<?php

declare(strict_types=1);

namespace Localheinz\PHPStan\Rules\Test\Fixture\Methods\NoParameterWithContainerTypeDeclarationRule\Success;

final class ClassWithMethodWithoutParameter
{
    public function method(): void
    {
    }
}
