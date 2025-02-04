<?php
/**
 * Class ExtendedEuclidean
 *
 * Implements the Extended Euclidean algorithm to compute the Greatest Common Divisor (GCD) of two integers.
 * It uses an iterative approach to avoid deep recursion, making it efficient even for large integers.
 *
 * @package Xenosuter\NumberTheoryCore\Algorithms
 * @see https://en.wikipedia.org/wiki/Extended_Euclidean_algorithm
 * @author Xeno Suter
 */

namespace Xenosuter\NumberTheoryCore\Algorithms\BinaryGcd\Euclidean;

use Xenosuter\NumberTheoryCore\Contracts\NumberTheoryAlgorithmInterface;

class ExtendedEuclidean implements NumberTheoryAlgorithmInterface
{
    /**
     * Computes the Greatest Common Divisor (GCD) of two integers using the Extended Euclidean algorithm.
     *
     * This method computes the GCD of two integers and also returns the coefficients (x, y) such that:
     * \( a \cdot x + b \cdot y = \text{gcd}(a, b) \).
     * These coefficients are useful in applications such as finding modular inverses.
     * The algorithm follows an iterative approach to avoid deep recursion, making it more efficient.
     *
     * @param int ...$args
     * @return array An array containing the GCD, x, and y: [gcd, x, y].
     */
    public static function execute(int ...$args): array
    {
        if (count($args) !== 2) {
            throw new \InvalidArgumentException("Extended Euclidean algorithm requires exactly 2 integers.");
        }

        [$a, $b] = $args;
        $x = 0;
        $y = 1;
        $lastX = 1;
        $lastY = 0;

        while ($b !== 0) {
            $quotient = intdiv($a, $b);
            [$a, $b] = [$b, $a % $b];
            [$x, $lastX] = [$lastX - $quotient * $x, $x];
            [$y, $lastY] = [$lastY - $quotient * $y, $y];
        }

        return [abs($a), $lastX, $lastY];
    }
}
