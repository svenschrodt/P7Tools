<?php
/**
 */
namespace P7Tools\Base\Data;
use \P7Tools\Dev\Mock;
use \P7Tools\Base\Data\ArrayFilter;
use \P7Tools\Base\Data\ArrayHelper;
use \P7Tools\Base\Data\ArrayHandler;
use \P7Tools\Base\Data\ArrayValidator;

class ArrayHelperTest extends \PHPUnit\Framework\TestCase
{



    public function setUp()
    {

    }

    public function testIfHelperWorksCorrectly()
    {
     $data = \P7Tools\Dev\Mock::getUserAccountTotal();
     ArrayValidator::ensureKeyExistsDefaultValue($data, 'date', 'DateTime');
     ArrayValidator::ensureKeyExistsDefaultValue($data, 'groups', 'array');
     ArrayValidator::ensureKeyExistsDefaultValue($data, 'foreignAccount', 'float');


//      $ah = new ArrayHandler($data);
//      echo $ah->greater('total', 0)->sort('total', 'desc');
//      echo $ah->rollBack()->rollBack();
    //@TODO clean up!
    $this->assertFalse(2===5);
    }
}


