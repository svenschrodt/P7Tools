<?php
/**
 */
namespace P7Tools\Base\Data;

use \P7Tools\Dev\Mock;
use \P7Tools\Base\Data\ArrayFilter;
use \P7Tools\Base\Data\ArrayHelper;
use \P7Tools\Base\Data\ArrayValidator;
use \P7Tools\Base\Data\ArrayHandler;

class ArrayHandlerTest extends \PHPUnit\Framework\TestCase
{

    protected $_memory;

    //@TODO clean up this mess and rebuild Notest* functions to working test*
    public function testDummy()
    {
        $this->assertTrue(2==1+1);
    }
    
    // public function setUp() : void
    // {
    // $this->_memory = memory_get_usage();
    // echo PHP_EOL .'______________________' . PHP_EOL;
    // echo date('H:i:s') .$this->_memory;
    // echo PHP_EOL .'______________________' . PHP_EOL;
    // //echo getcwd();

    // }

    // public function tearDown()
    // {
    // $diff = round((memory_get_usage() - $this->_memory)/1024*1024, 2);
    // echo PHP_EOL .'______________________' . PHP_EOL;
    // echo date('H:i:s') . '--' .$diff . ' MB';
    // echo PHP_EOL .'______________________' . PHP_EOL;

    // }
    
    
    
    public function NotestAll()
    {
        $ah = new ArrayHandler(\P7Tools\Dev\Mock::getGeneratedData());
        echo $ah->begins('country', 'Ch')
        ->notBegins('gUid', 'AA')
        ->sortNamePart('name',1, 'DESC');
//         $countries = ArrayHelper::getPropertyListFromCollection($ah->getCurrent(), 'country');
//         sort($countries);
//         var_dump($countries);
        $ah->clearOperations();
        echo PHP_EOL . '______________________' . PHP_EOL;
        echo count($ah);
    }

    public function NotestSortAndFilter()
    {
        $ah = new ArrayHandler(Mock::getUserAccountTotal());

        echo PHP_EOL . '______________________' . PHP_EOL;
        echo $ah->between('id', 2048, 399)
            ->notBegins('employeeName', 'Lou')
            ->sort('id')
            ->notEnds('employeeName', 'Stub');
        echo PHP_EOL . '______________________' . PHP_EOL;
        echo $ah->clearOperations();

        $data = $ah->sort('total');
        foreach ($data as $item) {
            $total = isset($item['id']) ? $item['id'] : 'N/A';
            echo $item['employeeName'] . ' ' . $total . PHP_EOL;
        }
        // ArrayHelper::$elementSeparator=PHP_EOL;
        echo ArrayHelper::getArrayAsString(ArrayFilter::getFilterNames());
    }

    public function NotestFilterAndSorter()
    {
        $ah = new ArrayHandler(Mock::getUserAccountTotal());
        // echo $ah;
        echo count($ah);
        echo PHP_EOL . '______________________' . PHP_EOL;
        // $ah->contains('employeeName', 'Bar')->sort('employeeName');
        // echo $ah;
        echo $ah->max('total');
        echo PHP_EOL . '______________________' . PHP_EOL;
        $ah->rollBack();
        echo $ah->min('total');
        $ah->rollBack();
        echo PHP_EOL . '______________________' . PHP_EOL;
        foreach ($ah as $item) {
            echo $item['id'];
            echo PHP_EOL . '______________________' . PHP_EOL;
        }
        $ah->rollBack(); //
        $ah->sort('id');
        echo $ah;
        echo PHP_EOL . '______________________' . PHP_EOL;
        $ah->sortNamePart('employeeName', 1, 'desc');
        var_dump($ah->clearHistory());
        // foreach($ah as $item) {
        // echo $item['id'];echo PHP_EOL .'______________________' . PHP_EOL;
        // }
        // echo PHP_EOL .'______________________' . PHP_EOL;
        // echo count($ah);
        // var_dump($ah->getCurrent());
        // echo $ah;
    }
}


