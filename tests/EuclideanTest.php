<?php
/**
 * Class ExtendedEuclideanTest
 *
 * Tests for the ExtendedEuclidean algorithm for computing the Greatest Common Divisor (GCD) of two integers.
 *
 * @author Xeno Suter
 */

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Xenosuter\NumberTheoryCore\Algorithms\Euclidean;

class EuclideanTest extends TestCase
{
    public static function computeProvider(): iterable
    {
        yield 'gcd(6, 9) = 3' => [6, 9, 3];
        yield 'gcd(9, 6) = 3' => [9, 6, 3];
        yield 'gcd(0, 5) = 5' => [0, 5, 5];
        yield 'gcd(5, 0) = 5' => [5, 0, 5];
        yield 'gcd(0, 0) = 0' => [0, 0, 0];

        // Test cases for negative numbers
        yield 'gcd(-6, 9) = 3' => [-6, 9, 3];
        yield 'gcd(6, -9) = 3' => [6, -9, 3];
        yield 'gcd(-6, -9) = 3' => [-6, -9, 3];
        yield 'gcd(-1, 1) = 1' => [-1, 1, 1];
        yield 'gcd(1, -1) = 1' => [1, -1, 1];

        // Test cases for large numbers
        yield 'gcd(1234567890, 987654321) = 9' => [1234567890, 987654321, 9];
        yield 'gcd(1000000000, 1000000000) = 1000000000' => [1000000000, 1000000000, 1000000000];
        yield 'gcd(999999999, 123456789) = 9' => [999999999, 123456789, 9];
        yield 'gcd(9876543210, 1928374650) = 90' => [9876543210, 1928374650, 90];
    }

    #[DataProvider('computeProvider')]
    public function testCompute(int $a, int $b, int $expected): void
    {
        $this->assertSame($expected, Euclidean::gcd($a, $b));
    }
}
