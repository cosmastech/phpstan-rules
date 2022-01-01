<?php

declare(strict_types=1);

/**
 * Copyright (c) 2018-2022 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE.md file that was distributed with this source code.
 *
 * @see https://github.com/ergebnis/phpstan-rules
 */

namespace Ergebnis\PHPStan\Rules\Test\Integration\Closures;

use Ergebnis\PHPStan\Rules\Closures\NoParameterWithNullableTypeDeclarationRule;
use Ergebnis\PHPStan\Rules\Test\Integration\AbstractTestCase;
use PHPStan\Rules\Rule;

/**
 * @internal
 *
 * @covers \Ergebnis\PHPStan\Rules\Closures\NoParameterWithNullableTypeDeclarationRule
 */
final class NoParameterWithNullableTypeDeclarationRuleTest extends AbstractTestCase
{
    public function provideCasesWhereAnalysisShouldSucceed(): iterable
    {
        $paths = [
            'closure-with-parameter-with-type-declaration' => __DIR__ . '/../../Fixture/Closures/NoParameterWithNullableTypeDeclarationRule/Success/closure-with-parameter-with-type-declaration.php',
            'closure-with-parameter-without-type-declaration' => __DIR__ . '/../../Fixture/Closures/NoParameterWithNullableTypeDeclarationRule/Success/closure-with-parameter-without-type-declaration.php',
            'closure-without-parameters' => __DIR__ . '/../../Fixture/Closures/NoParameterWithNullableTypeDeclarationRule/Success/closure-without-parameters.php',
        ];

        foreach ($paths as $description => $path) {
            yield $description => [
                $path,
            ];
        }
    }

    public function provideCasesWhereAnalysisShouldFail(): iterable
    {
        $paths = [
            'closure-with-parameter-with-nullable-type-declaration' => [
                __DIR__ . '/../../Fixture/Closures/NoParameterWithNullableTypeDeclarationRule/Failure/closure-with-parameter-with-nullable-type-declaration.php',
                [
                    'Closure has parameter $bar with a nullable type declaration.',
                    7,
                ],
            ],
        ];

        foreach ($paths as $description => [$path, $error]) {
            yield $description => [
                $path,
                $error,
            ];
        }
    }

    protected function getRule(): Rule
    {
        return new NoParameterWithNullableTypeDeclarationRule();
    }
}
