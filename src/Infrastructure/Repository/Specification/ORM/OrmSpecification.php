<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository\Specification\ORM;

use App\Domain\Repository\Specification\SpecificationInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\Query\Parameter;

abstract class OrmSpecification implements SpecificationInterface
{
    protected ArrayCollection $parameters;


    public function __construct(protected Expr $expr)
    {
        $this->parameters = new ArrayCollection();
    }


    abstract public function getConditions();


    public function getParameters(): ArrayCollection
    {
        return $this->parameters;
    }


    public function and(SpecificationInterface $specification): SpecificationInterface
    {
        return new OrmAndSpecification($this, $specification, $this->expr);
    }


    public function or(SpecificationInterface $specification): SpecificationInterface
    {
        return new OrmOrSpecification($this, $specification, $this->expr);
    }


    protected function addParameters(SpecificationInterface $specification): void
    {
        foreach ($specification->getParameters() as $parameter) {
            $this->setParameter($parameter);
        }
    }


    protected function setParameter(Parameter $parameter): void
    {
        $this->parameters->add($parameter);
    }
}
