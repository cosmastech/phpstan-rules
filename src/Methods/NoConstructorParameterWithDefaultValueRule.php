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

namespace Ergebnis\PHPStan\Rules\Methods;

use Ergebnis\PHPStan\Rules\ErrorIdentifier;
use PhpParser\Node;
use PHPStan\Analyser;
use PHPStan\Reflection;
use PHPStan\Rules;

/**
 * @implements Rules\Rule<Node\Stmt\ClassMethod>
 */
final class NoConstructorParameterWithDefaultValueRule implements Rules\Rule
{
    public function getNodeType(): string
    {
        return Node\Stmt\ClassMethod::class;
    }

    public function processNode(
        Node $node,
        Analyser\Scope $scope
    ): array {
        if ('__construct' !== $node->name->toLowerString()) {
            return [];
        }

        if (0 === \count($node->params)) {
            return [];
        }

        $params = \array_filter($node->params, static function (Node\Param $node): bool {
            return null !== $node->default;
        });

        if (0 === \count($params)) {
            return [];
        }

        /** @var Reflection\ClassReflection $classReflection */
        $classReflection = $scope->getClassReflection();

        if ($classReflection->isAnonymous()) {
            return \array_values(\array_map(static function (Node\Param $node): Rules\RuleError {
                /** @var Node\Expr\Variable $variable */
                $variable = $node->var;

                /** @var string $parameterName */
                $parameterName = $variable->name;

                $message = \sprintf(
                    'Constructor in anonymous class has parameter $%s with default value.',
                    $parameterName,
                );

                return Rules\RuleErrorBuilder::message($message)
                    ->identifier(ErrorIdentifier::noConstructorParameterWithDefaultValue()->toString())
                    ->build();
            }, $params));
        }

        $className = $classReflection->getName();

        return \array_values(\array_map(static function (Node\Param $node) use ($className): Rules\RuleError {
            /** @var Node\Expr\Variable $variable */
            $variable = $node->var;

            /** @var string $parameterName */
            $parameterName = $variable->name;

            $message = \sprintf(
                'Constructor in %s has parameter $%s with default value.',
                $className,
                $parameterName,
            );

            return Rules\RuleErrorBuilder::message($message)
                ->identifier(ErrorIdentifier::noConstructorParameterWithDefaultValue()->toString())
                ->build();
        }, $params));
    }
}
