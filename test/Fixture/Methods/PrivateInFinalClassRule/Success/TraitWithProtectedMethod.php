<?php

declare(strict_types=1);

namespace Ergebnis\PHPStan\Rules\Test\Fixture\Methods\PrivateInFinalClassRule\Success;

trait TraitWithProtectedMethod
{
    protected function method(): void
    {
    }
}
