<?php

declare(strict_types=1);

namespace Ergebnis\PHPStan\Rules\Test\Fixture\Methods\FinalInAbstractClassRule;

/** @Entity */
abstract class AbstractClassWithProtectedMethodAndEntityAnnotationInInlineDocBlock
{
    protected function method(): void
    {
    }
}
