<?php

declare(strict_types=1);

namespace Ergebnis\PHPStan\Rules\Test\Fixture\Closures\NoNullableReturnTypeDeclarationRule\Failure;

$foo = function (): null|string {
    return 'Hello';
};
