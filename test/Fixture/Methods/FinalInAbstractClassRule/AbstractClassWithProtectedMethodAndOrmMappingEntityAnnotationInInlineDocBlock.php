<?php

declare(strict_types=1);

namespace Ergebnis\PHPStan\Rules\Test\Fixture\Methods\FinalInAbstractClassRule;

/** @ORM\Mapping\Entity */
abstract class AbstractClassWithProtectedMethodAndOrmMappingEntityAnnotationInInlineDocBlock
{
    protected function method(): void
    {
    }
}
