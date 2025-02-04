<?php

namespace Xenosuter\NumberTheoryCore;

use Xenosuter\NumberTheoryCore\Contracts\NumberTheoryAlgorithmInterface;

class NumberTheoryContext
{
    private NumberTheoryAlgorithmInterface $algorithm;

    public function __construct(string $type, int $a, int $b)
    {
        $this->algorithm = NumberTheoryAlgorithmFactory::create($type, $a, $b);
    }

    public function execute(...$args): mixed
    {
        return $this->algorithm::execute(...$args);
    }
}
