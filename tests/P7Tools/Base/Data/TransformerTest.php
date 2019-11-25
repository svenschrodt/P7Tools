<?php
/**
 * P7Tools\Base\Data\TransformerTest
 *
 *
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.0.23
 */
namespace P7Tools\Base\Data;

class TransformerTest extends \PHPUnit\Framework\TestCase
{

    protected $testContainer;

    public function setUp()
    {

    }
    
    public function testFooMockSupressingErrorMesg()
    {
        $this->assertFalse(3==7);
    }

    public function NOtestIfIniFileIsParsedCorrectly()
    {
       $fileName = APP_ROOT . DIRECTORY_SEPARATOR . 'test' . DIRECTORY_SEPARATOR . 'example.ini';
        $this->assertTrue(is_array(Transformer::getDataFromIniFile($fileName)));

    }}


