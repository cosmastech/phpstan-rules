<?php

declare(strict_types=1);

namespace Ergebnis\PHPStan\Rules\Test\Fixture\Methods\PrivateInFinalClassRule\Success;

final class FinalClassWithProtectedMethodFromTrait
{
    use TraitWithProtectedMethod;
}
