<?php

declare(strict_types=1);

namespace Ergebnis\PHPStan\Rules\Test\Fixture\Expressions\NoSwitchRule;

if ('foo' === $foo) {
    return 'It is foo!';
}

if ('bar' === $foo) {
    return 'It is bar!';
}
