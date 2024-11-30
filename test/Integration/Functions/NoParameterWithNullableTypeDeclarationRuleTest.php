<?php

declare(strict_types=1);

/**
 * Copyright (c) 2018-2024 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE.md file that was distributed with this source code.
 *
 * @see https://github.com/ergebnis/phpstan-rules
 */

namespace Ergebnis\PHPStan\Rules\Test\Integration\Functions;

use Ergebnis\PHPStan\Rules\Functions;
use Ergebnis\PHPStan\Rules\Test;
use PhpParser\Node;
use PHPStan\Rules;
use PHPUnit\Framework;

#[Framework\Attributes\CoversClass(Functions\NoParameterWithNullableTypeDeclarationRule::class)]
final class NoParameterWithNullableTypeDeclarationRuleTest extends Test\Integration\AbstractTestCase
{
    public static function provideCasesWhereAnalysisShouldSucceed(): iterable
    {
        $paths = [
            'function-with-parameter-with-type-declaration' => __DIR__ . '/../../Fixture/Functions/NoParameterWithNullableTypeDeclarationRule/Success/function-with-parameter-with-type-declaration.php',
            'function-with-parameter-without-type-declaration' => __DIR__ . '/../../Fixture/Functions/NoParameterWithNullableTypeDeclarationRule/Success/function-with-parameter-without-type-declaration.php',
            'function-without-parameters' => __DIR__ . '/../../Fixture/Functions/NoParameterWithNullableTypeDeclarationRule/Success/function-without-parameters.php',
        ];

        foreach ($paths as $description => $path) {
            yield $description => [
                $path,
            ];
        }
    }

    public static function provideCasesWhereAnalysisShouldFail(): iterable
    {
        $paths = [
            'function-with-parameter-with-nullable-type-declaration' => [
                __DIR__ . '/../../Fixture/Functions/NoParameterWithNullableTypeDeclarationRule/Failure/function-with-parameter-with-nullable-type-declaration.php',
                [
                    'Function Ergebnis\PHPStan\Rules\Test\Fixture\Functions\NoParameterWithNullableTypeDeclarationRule\Failure\foo() has parameter $bar with a nullable type declaration.',
                    7,
                ],
            ],
            'function-with-parameter-with-nullable-union-type-declaration' => [
                __DIR__ . '/../../Fixture/Functions/NoParameterWithNullableTypeDeclarationRule/Failure/function-with-parameter-with-nullable-union-type-declaration.php',
                [
                    'Function Ergebnis\PHPStan\Rules\Test\Fixture\Functions\NoParameterWithNullableTypeDeclarationRule\Failure\foo() has parameter $bar with a nullable type declaration.',
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

    /**
     * @return Rules\Rule<Node\Stmt\Function_>
     */
    protected function getRule(): Rules\Rule
    {
        return new Functions\NoParameterWithNullableTypeDeclarationRule();
    }
}
