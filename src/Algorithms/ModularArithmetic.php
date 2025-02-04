<?php
/**
 * Class ModularArithmetic
 *
 * Provides methods for performing modular arithmetic operations, including finding modular inverses
 * and computing modular exponentiation.
 *
 * These operations are fundamental in number theory and are widely used in fields such as cryptography.
 * This class implements efficient algorithms to handle these computations.
 *
 * @package Xenosuter\NumberTheoryCore\Algorithms
 * @see https://en.wikipedia.org/wiki/Modular_arithmetic
 * @see https://en.wikipedia.org/wiki/Modular_exponentiation
 * @author Xeno Suter
 */

namespace Xenosuter\NumberTheoryCore\Algorithms;

class ModularArithmetic
{
    /**
     * Computes the modular inverse of an integer modulo m.
     *
     * The modular inverse of a number \( a \) modulo \( m \) is an integer \( x \) such that:
     * \( a \cdot x \equiv 1 \pmod{m} \).
     * This method uses the Extended Euclidean algorithm to determine the modular inverse.
     *
     * @param int $a The number for which the modular inverse is to be calculated.
     * @param int $m The modulus.
     * @return int|null The modular inverse, or null if the inverse does not exist.
     */
    public static function modInverse(int $a, int $m): ?int
    {
        [$gcd, $x] = ExtendedEuclidean::compute($a, $m);
        return $gcd === 1 ? abs(($x % $m + $m) % $m) : null;
    }

    /**
     * Computes the result of modular exponentiation: \( (base^{exp}) \mod mod \).
     *
     * Modular exponentiation is an efficient algorithm to compute large powers modulo a number
     * without directly calculating the large intermediate powers, which can lead to overflow.
     * This implementation uses an iterative approach known as "exponentiation by squaring."
     *
     * @param int $base The base of the exponentiation.
     * @param int $exp The exponent.
     * @param int $mod The modulus.
     * @return int The result of \( (base^{exp}) \mod mod \).
     */
    public static function modExp(int $base, int $exp, int $mod): int
    {
        $result = 1;
        $base %= $mod;

        while ($exp > 0) {
            if ($exp & 1) {
                $result = ($result * $base) % $mod;
            }
            $base = ($base * $base) % $mod;
            $exp >>= 1;
        }

        return $result;
    }
}
