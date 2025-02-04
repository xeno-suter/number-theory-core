<?php
/**
 * Class ExtendedEuclidean
 *
 * Implements the ExtendedEuclidean algorithm for computing the Greatest Common Divisor (GCD) of two integers.
 * The ExtendedEuclidean algorithm is a classic method for finding the greatest common divisor (GCD) of two numbers.
 * This implementation uses the iterative approach to avoid deep recursion.
 *
 * @package Xenosuter\NumberTheoryCore\Algorithms
 * @see https://en.wikipedia.org/wiki/Euclidean_algorithm
 * @author Xeno Suter
 */

namespace Xenosuter\NumberTheoryCore\Algorithms\BinaryGcd\Euclidean;

use Xenosuter\NumberTheoryCore\Contracts\NumberTheoryAlgorithmInterface;

class Euclidean implements NumberTheoryAlgorithmInterface
{
    /**
     * Computes the Greatest Common Divisor (GCD) of two integers using the ExtendedEuclidean algorithm.
     *
     * This method uses an iterative approach to compute the GCD, which repeatedly replaces the larger
     * number by its remainder when divided by the smaller number until one of the numbers becomes zero.
     * The non-zero number at that point is the GCD. The absolute value of the result is returned to ensure
     * it is always positive.
     *
     * @param int ...$args The two integers for which the GCD is to be computed.
     * @return int The greatest common divisor of the two integers
     */
    public static function execute(int ...$args): int
    {
        if (count($args) !== 2) {
            throw new \InvalidArgumentException("Euclidean algorithm requires exactly 2 integers.");
        }

        [$a, $b] = $args;

        while ($b !== 0) {
            [$a, $b] = [$b, $a % $b];
        }

        return abs($a);
    }
}
