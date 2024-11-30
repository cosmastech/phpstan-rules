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

namespace Ergebnis\PHPStan\Rules\Expressions;

use Ergebnis\PHPStan\Rules\ErrorIdentifier;
use PhpParser\Node;
use PHPStan\Analyser;
use PHPStan\Rules;

/**
 * @implements Rules\Rule<Node\Expr\Eval_>
 */
final class NoEvalRule implements Rules\Rule
{
    public function getNodeType(): string
    {
        return Node\Expr\Eval_::class;
    }

    public function processNode(
        Node $node,
        Analyser\Scope $scope,
    ): array {
        $ruleErrorBuilder = Rules\RuleErrorBuilder::message('Language construct eval() should not be used.');

        return [
            $ruleErrorBuilder->identifier(ErrorIdentifier::noEval()->toString())->build(),
        ];
    }
}
