<?php
/*
 * @author Xeno Suter
 */

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Xenosuter\NumberTheoryCore\Algorithms\ModularArithmetic;

class ModularArithmeticTest extends TestCase
{
    /**
     * Data provider for modInverse tests.
     * Uses yield for improved readability.
     */
    public static function modInverseProvider(): iterable
    {
        yield 'modInverse(2, 5) = 3' => [2, 5, 3];
        yield 'modInverse(3, 7) = 5' => [3, 7, 5];
        yield 'modInverse(4, 7) = 2' => [4, 7, 2];

        yield 'modInverse(-2, 5) = 2' => [-2, 5, 2];
        yield 'modInverse(2, -5) = 3' => [2, -5, 3];
        yield 'modInverse(-2, -5) = 3' => [-2, -5, 2];

        yield 'modInverse(0, 5) = null' => [0, 5, null];
        yield 'modInverse(2, 0) = null' => [2, 0, null];
        yield 'modInverse(0, 0) = null' => [0, 0, null];
    }

    #[dataProvider('modInverseProvider')]
    public function testModInverse(int $a, int $m, ?int $expected): void
    {
        $this->assertSame($expected, ModularArithmetic::modInverse($a, $m));
    }

    /**
     * Data provider for modExp tests.
     * Uses yield for cleaner code.
     */
    public static function modExpProvider(): iterable
    {
        yield '2^0 % 5 = 1' => [2, 0, 5, 1];
        yield '2^2 % 5 = 4' => [2, 2, 5, 4];
        yield '2^3 % 5 = 3' => [2, 3, 5, 3];

        yield '3^3 % 7 = 6' => [3, 3, 7, 6];
        yield '3^4 % 7 = 4' => [3, 4, 7, 4];
        yield '3^5 % 7 = 5' => [3, 5, 7, 5];

        yield '4^4 % 7 = 4' => [4, 4, 7, 4];
        yield '4^5 % 7 = 2' => [4, 5, 7, 2];

        yield '5^5 % 7 = 3' => [5, 5, 7, 3];
        yield '5^6 % 7 = 1' => [5, 6, 7, 1];

        yield '6^6 % 7 = 1' => [6, 6, 7, 1];
        yield '6^7 % 7 = 6' => [6, 7, 7, 6];

        yield '7^7 % 7 = 0' => [7, 7, 7, 0];
        yield '7^8 % 7 = 0' => [7, 8, 7, 0];
    }

    #[dataProvider('modExpProvider')]
    public function testModExp(int $base, int $exp, int $mod, int $expected): void
    {
        $this->assertSame($expected, ModularArithmetic::modExp($base, $exp, $mod));
    }
}
