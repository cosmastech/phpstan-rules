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

use PhpParser\Node;
use PHPStan\Analyser;
use PHPStan\Reflection;
use PHPStan\Rules;
use PHPStan\ShouldNotHappenException;

final class NoConstructorParameterWithDefaultValueRule implements Rules\Rule
{
    public function getNodeType(): string
    {
        return Node\Stmt\ClassMethod::class;
    }

    public function processNode(
        Node $node,
        Analyser\Scope $scope,
    ): array {
        if (!$node instanceof Node\Stmt\ClassMethod) {
            throw new ShouldNotHappenException(\sprintf(
                'Expected node to be instance of "%s", but got instance of "%s" instead.',
                Node\Stmt\ClassMethod::class,
                $node::class,
            ));
        }

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
            return \array_map(static function (Node\Param $node): Rules\RuleError {
                /** @var Node\Expr\Variable $variable */
                $variable = $node->var;

                /** @var string $parameterName */
                $parameterName = $variable->name;

                $ruleErrorBuilder = Rules\RuleErrorBuilder::message(\sprintf(
                    'Constructor in anonymous class has parameter $%s with default value.',
                    $parameterName,
                ));

                return $ruleErrorBuilder->build();
            }, $params);
        }

        $className = $classReflection->getName();

        return \array_map(static function (Node\Param $node) use ($className): string {
            /** @var Node\Expr\Variable $variable */
            $variable = $node->var;

            /** @var string $parameterName */
            $parameterName = $variable->name;

            return \sprintf(
                'Constructor in %s has parameter $%s with default value.',
                $className,
                $parameterName,
            );
        }, $params);
    }
}
