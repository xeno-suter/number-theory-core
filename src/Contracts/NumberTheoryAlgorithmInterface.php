<?php

namespace Xenosuter\NumberTheoryCore\Contracts;

interface NumberTheoryAlgorithmInterface
{
    /**
     * Executes the algorithm on the given inputs.
     *
     * @param mixed ...$args The arguments needed for the algorithm.
     * @return mixed The result of the algorithm.
     */
    public static function execute(int ...$args): mixed;
}
