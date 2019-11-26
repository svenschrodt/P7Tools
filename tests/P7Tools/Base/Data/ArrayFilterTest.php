<?php
/**
 */
namespace P7Tools\Base\Data;
use \P7Tools\Dev\Mock;
use \P7Tools\Base\Data\ArrayFilter;
use \P7Tools\Base\Data\ArrayHelper;
use \P7Tools\Base\Data\ArrayValidator;

class ArrayFilterTest extends \PHPUnit\Framework\TestCase
{



    public function setUp() : void 
    {

    }

    public function NOtestFilter()
    {
        $data = Mock::getUserAccountTotal();
//        echo ArrayHelper::getMultiArrayAsString($data, true);
//        die;
//        echo PHP_EOL;
//        echo ArrayHelper::getArrayAsString($data[8], true);
        $between = array('from'=>0,'to'=> 100);
        $filtered = ArrayFilter::filterArrayOfArrays('total', $between, $data, ArrayFilter::FILTER_MODE_BETWEEN);
//         echo ArrayHelper::getMultiArrayAsString($filtered, true);
    }


    public function testIfFilterWorksCorrectly()
    {
       // echo "YEP" . __FUNCTION__;
        $data = Mock::getUserDataHistory();
        // var_dump($data);die;
        $filtered = ArrayFilter::filterArrayOfArrays('employeeName', 'Bar',
                $data, ArrayFilter::FILTER_MODE_BEGINS);
       // $this->assertTrue(99==='FOO');

        $this->assertSame(count($filtered), 1);
        $filtered = ArrayFilter::filterArrayOfArrays('employeeName', 'Bar',
                $data, ArrayFilter::FILTER_MODE_CONTAINS);
        $names = ArrayHelper::getPropertyListFromCollection($filtered,
                'employeeName');
        $this->assertTrue(in_array('Foo Bartender', $names));
        $this->assertTrue(in_array('Bar Fighter', $names));
        $this->assertFalse(in_array('Example Lorem Ipsum', $names));

        // var_dump($filtered);die;
        $this->assertSame(3, count($filtered));

    }
}


