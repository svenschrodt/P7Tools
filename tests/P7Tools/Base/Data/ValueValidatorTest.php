<?php
/**
 */
namespace P7Tools\Base\Data;

use \P7Tools\Dev\Mock;
use \P7Tools\Base\Data\ValueValidator;
use P7Tools;


class ValueValidatorTest extends \PHPUnit\Framework\TestCase
{

    public function setUp()
    {
//         var_dump(P7Tools\Base\Data\ArrayFilter::getFilterNames());
//         die;

    }

    public function testIfValidationWorksCorrectly()
    {
        $this->assertTrue(ValueValidator::begins('LoremIpsum', 'Lorem'));
        $this->assertTrue(ValueValidator::contains('LoremIpsum', 'Lorem'));
        $this->assertTrue(ValueValidator::contains('LoremIpsum', 'remIps'));

        $this->assertTrue(ValueValidator::ends('LoremIpsum', 'sum'));
        $this->assertTrue(ValueValidator::ends('Problemm', 'm'));

        $this->assertTrue(ValueValidator::isIdentical(2*33, 66));

        $a = new \stdClass();
        $b = clone $a;
        $c = &$a;
        $this->assertTrue(ValueValidator::isIdentical($a, $c));
        $this->assertFalse(ValueValidator::isIdentical('99', 99));
        $this->assertTrue(ValueValidator::equals(99, '99'));
        $this->assertTrue(ValueValidator::equals($a, $b));
        $this->assertTrue(ValueValidator::equals($c, $b));
        $this->assertTrue(ValueValidator::isBetween(105, 99,105));

        $this->assertFalse(ValueValidator::isIn('', array(1,2,3,null)));
        $this->assertTrue(ValueValidator::isIn('', array(1,2,3,null), false));

    }
}


