<?php

declare(strict_types=1);

namespace App\Domain\Repository\Specification;

use Doctrine\Common\Collections\ArrayCollection;

interface SpecificationInterface
{
    public function getConditions();

    public function getParameters(): ArrayCollection;

    public function and(self $specification): self;

    public function or(self $specification): self;
}
