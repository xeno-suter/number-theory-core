<?php
/*
 * @author Xeno Suter
 */

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Xenosuter\NumberTheoryCore\Algorithms\ExtendedEuclidean;

class ExtendedEuclideanTest extends TestCase
{
    /**
     * Data provider for ExtendedEuclidean tests.
     * Uses yield for improved readability.
     */
    public static function extendedEuclideanProvider(): iterable
    {
        yield 'gcd(6, 9) = 3' => [6, 9, [3, -1, 1]];
        yield 'gcd(0, 5) = 5' => [0, 5, [5, 0, 1]];
        yield 'gcd(5, 0) = 5' => [5, 0, [5, 1, 0]];
        yield 'gcd(0, 0) = 0' => [0, 0, [0, 1, 0]];
        yield 'gcd(1, 1) = 1' => [1, 1, [1, 0, 1]];
        yield 'gcd(1, 0) = 1' => [1, 0, [1, 1, 0]];
        yield 'gcd(0, 1) = 1' => [0, 1, [1, 0, 1]];

        yield 'gcd(-6, 9) = 3' => [-6, 9, [3, 1, 1]];
        yield 'gcd(6, -9) = 3' => [6, -9, [3, 1, 1]];

        yield 'gcd(123456789, 987654321) = 9' => [123456789, 987654321, [9, -8, 1]];
        yield 'gcd(987654321, 123456789) = 9' => [987654321, 123456789, [9, 1, -8]];
    }

    #[dataProvider('extendedEuclideanProvider')]
    public function testExtendedEuclidean(int $a, int $b, array $expected): void
    {
        list($expectedGcd, $expectedX, $expectedY) = $expected;
        [$gcd, $x, $y] = ExtendedEuclidean::compute($a, $b);

        self::assertSame($expectedGcd, $gcd);
        self::assertSame($expectedX, $x);
        self::assertSame($expectedY, $y);
    }
}
