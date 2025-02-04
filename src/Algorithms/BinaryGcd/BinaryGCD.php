<?php

namespace Xenosuter\NumberTheoryCore\Algorithms\BinaryGcd;

use Xenosuter\NumberTheoryCore\Contracts\NumberTheoryAlgorithmInterface;

class BinaryGCD implements NumberTheoryAlgorithmInterface
{
    public static function execute(int ...$args): int
    {
        if (count($args) !== 2) {
            throw new \InvalidArgumentException("Binary GCD algorithm requires exactly 2 integers.");
        }

        [$a, $b] = $args;

        if ($a === 0) return abs($b);
        if ($b === 0) return abs($a);

        $shift = 0;

        while ((($a | $b) & 1) === 0) { // Both even
            $a >>= 1;
            $b >>= 1;
            $shift++;
        }

        while (($a & 1) === 0) { // Remove factors of 2 from a
            $a >>= 1;
        }

        while ($b !== 0) {
            while (($b & 1) === 0) { // Remove factors of 2 from b
                $b >>= 1;
            }

            if ($a > $b) { // Swap if necessary
                [$a, $b] = [$b, $a];
            }

            $b -= $a;
        }

        return $a << $shift; // Restore common factors of 2
    }
}
