<?php
/**
 */
namespace P7Tools\Base\Data;

use \P7Tools\Dev\Mock;
// use \P7Tools\Base\Data\ArrayValidator;
use \P7Tools\Base\Data\ArraySorter;

class ArraySorterTest extends \PHPUnit\Framework\TestCase
{

    public function setUp()
    {}

    
    public function testFooMockSupressingErrorMesg()
    {
        $this->assertFalse(3==7);
    }
    
    
    public function NOtestIfSortWorksCorrectly()
    {

      //  echo PHP_EOL . PHP_EOL . (1024*8). PHP_EOL. PHP_EOL;
       $data = Mock::getUserAccountTotal();
       ArraySorter::sortByKeyNumeric($data, 'total', 'DESC');
       foreach($data as $item) {
           echo implode(' | ', $item) ."\n";
       }
       echo "------------------\n";
       ArraySorter::sortByKeyAlpha($data, 'employeeName', 'ASC');
       foreach($data as $item) {
           echo implode(' | ', $item) ."\n";
       }
       echo "------------------\n";
       ArraySorter::sortByKeyPartOfValue($data, 'employeeName', 'DESC');
       foreach($data as $item) {
           echo implode(' | ', $item) ."\n";
       }


    }
}


