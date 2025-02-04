<?php

namespace Xenosuter\NumberTheoryCore;

use InvalidArgumentException;
use Xenosuter\NumberTheoryCore\Algorithms\BinaryGcd\BinaryGCD;
use Xenosuter\NumberTheoryCore\Algorithms\BinaryGcd\Euclidean\Euclidean;
use Xenosuter\NumberTheoryCore\Algorithms\BinaryGcd\Euclidean\ExtendedEuclidean;
use Xenosuter\NumberTheoryCore\Contracts\NumberTheoryAlgorithmInterface;

class NumberTheoryAlgorithmFactory
{
    /**
     * Stores registered algorithms.
     *
     * @var array<string, callable>
     */
    private static array $algorithms = [];

    /**
     * Registers a custom algorithm.
     *
     * @param string $type The type of algorithm (e.g., "gcd", "extended_gcd").
     * @param callable $callback A factory function that returns an instance of NumberTheoryAlgorithmInterface.
     */
    public static function register(string $type, callable $callback): void
    {
        self::$algorithms[$type] = $callback;
    }

    /**
     * Creates an instance of the selected algorithm.
     *
     * @param string $type The type of algorithm (e.g., "gcd", "extended_gcd").
     * @param mixed $a First number (could be string, int, etc.).
     * @param mixed $b Second number (could be string, int, etc.).
     * @return NumberTheoryAlgorithmInterface The selected algorithm.
     * @throws InvalidArgumentException If the algorithm type is unknown or input types are invalid.
     */
    public static function create(string $type, $a, $b): NumberTheoryAlgorithmInterface
    {
        // Validate inputs at runtime
        if (!self::isValidInput($a) || !self::isValidInput($b)) {
            throw new InvalidArgumentException("Both inputs must be valid integers or numeric strings.");
        }

        // Allow custom-registered algorithms to take priority
        if (isset(self::$algorithms[$type])) {
            return (self::$algorithms[$type])($a, $b);
        }

        // Default selection logic
        $maxValue = max(abs($a), abs($b));

        if ($type === "gcd") {
            return $maxValue < 1_000_000
                ? new Euclidean()
                : new BinaryGCD();
        } elseif ($type === "extended_gcd") {
            return new ExtendedEuclidean();
        }

        throw new InvalidArgumentException("Unknown algorithm type: $type");
    }

    /**
     * Checks if the input is a valid numeric value (int or string representing an integer).
     *
     * @param mixed $value
     * @return bool
     */
    private static function isValidInput(mixed $value): bool
    {
        return is_int($value) || (is_string($value) && is_numeric($value));
    }
}
