<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository\Specification\ORM;

use App\Domain\Repository\Specification\SpecificationInterface;
use Doctrine\ORM\Query\Expr;

class OrmAndSpecification extends OrmSpecification
{
    public function __construct(
        private readonly SpecificationInterface $left,
        private readonly SpecificationInterface $right,
        Expr                                    $expr,
    ) {
        parent::__construct($expr);

        $this->addParameters($left);
        $this->addParameters($right);
    }



    public function getConditions(): Expr\Andx
    {
        return $this->expr->andX(
            $this->left->getConditions(),
            $this->right->getConditions()
        );
    }
}
