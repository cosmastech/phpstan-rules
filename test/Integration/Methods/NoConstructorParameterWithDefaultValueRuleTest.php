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

namespace Ergebnis\PHPStan\Rules\Test\Integration\Methods;

use Ergebnis\PHPStan\Rules\ErrorIdentifier;
use Ergebnis\PHPStan\Rules\Methods;
use Ergebnis\PHPStan\Rules\Test;
use PhpParser\Node;
use PHPStan\Rules;
use PHPUnit\Framework;

#[Framework\Attributes\CoversClass(Methods\NoConstructorParameterWithDefaultValueRule::class)]
#[Framework\Attributes\UsesClass(ErrorIdentifier::class)]
final class NoConstructorParameterWithDefaultValueRuleTest extends Test\Integration\AbstractTestCase
{
    public static function provideCasesWhereAnalysisShouldSucceed(): iterable
    {
        $paths = [
            'constructor-in-anonymous-class-with-parameter-without-default-value' => __DIR__ . '/../../Fixture/Methods/NoConstructorParameterWithDefaultValueRule/Success/constructor-in-anonymous-class-with-parameter-without-default-value.php',
            'constructor-in-anonymous-class-without-parameters' => __DIR__ . '/../../Fixture/Methods/NoConstructorParameterWithDefaultValueRule/Success/constructor-in-anonymous-class-without-parameters.php',
            'constructor-in-class-with-parameter-without-default-value' => __DIR__ . '/../../Fixture/Methods/NoConstructorParameterWithDefaultValueRule/Success/ConstructorInClassWithParameterWithoutDefaultValue.php',
            'constructor-in-class-without-parameters' => __DIR__ . '/../../Fixture/Methods/NoConstructorParameterWithDefaultValueRule/Success/ConstructorInClassWithoutParameters.php',
            // traits are not supported
            'constructor-in-trait-with-parameter-with-default-value' => __DIR__ . '/../../Fixture/Methods/NoConstructorParameterWithDefaultValueRule/Success/ConstructorInTraitWithParameterWithDefaultValue.php',
            'constructor-in-trait-with-parameter-without-default-value' => __DIR__ . '/../../Fixture/Methods/NoConstructorParameterWithDefaultValueRule/Success/ConstructorInTraitWithParameterWithoutDefaultValue.php',
            'constructor-in-trait-without-parameters' => __DIR__ . '/../../Fixture/Methods/NoConstructorParameterWithDefaultValueRule/Success/ConstructorInTraitWithoutParameters.php',
            // non-constructor-methods
            'method-in-anonymous-class-with-parameter-with-default-value' => __DIR__ . '/../../Fixture/Methods/NoConstructorParameterWithDefaultValueRule/Success/method-in-anonymous-class-with-parameter-with-default-value.php',
            'method-in-class-with-parameter-with-default-value' => __DIR__ . '/../../Fixture/Methods/NoConstructorParameterWithDefaultValueRule/Success/MethodInClassWithParameterWithDefaultValue.php',
            'method-in-trait-with-parameter-with-default-value' => __DIR__ . '/../../Fixture/Methods/NoConstructorParameterWithDefaultValueRule/Success/MethodInTraitWithParameterWithDefaultValue.php',
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
            'constructor-in-anonymous-class-with-parameter-with-default-value' => [
                __DIR__ . '/../../Fixture/Methods/NoConstructorParameterWithDefaultValueRule/Failure/constructor-in-anonymous-class-with-parameter-with-default-value.php',
                [
                    'Constructor in anonymous class has parameter $bar with default value.',
                    8,
                ],
            ],
            'constructor-with-wrong-capitalization-in-anonymous-class-with-parameter-with-default-value' => [
                __DIR__ . '/../../Fixture/Methods/NoConstructorParameterWithDefaultValueRule/Failure/constructor-with-wrong-capitalization-in-anonymous-class-with-parameter-with-default-value.php',
                [
                    'Constructor in anonymous class has parameter $bar with default value.',
                    8,
                ],
            ],
            'constructor-in-class-with-parameter-with-default-value' => [
                __DIR__ . '/../../Fixture/Methods/NoConstructorParameterWithDefaultValueRule/Failure/ConstructorInClassWithParameterWithDefaultValue.php',
                [
                    \sprintf(
                        'Constructor in %s has parameter $bar with default value.',
                        Test\Fixture\Methods\NoConstructorParameterWithDefaultValueRule\Failure\ConstructorInClassWithParameterWithDefaultValue::class,
                    ),
                    9,
                ],
            ],
            'constructor-with-wrong-capitalization-in-class-with-parameter-with-default-value' => [
                __DIR__ . '/../../Fixture/Methods/NoConstructorParameterWithDefaultValueRule/Failure/ConstructorWithWrongCapitalizationInClassWithParameterWithDefaultValue.php',
                [
                    \sprintf(
                        'Constructor in %s has parameter $bar with default value.',
                        Test\Fixture\Methods\NoConstructorParameterWithDefaultValueRule\Failure\ConstructorWithWrongCapitalizationInClassWithParameterWithDefaultValue::class,
                    ),
                    9,
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
     * @return Rules\Rule<Node\Stmt\ClassMethod>
     */
    protected function getRule(): Rules\Rule
    {
        return new Methods\NoConstructorParameterWithDefaultValueRule();
    }
}
