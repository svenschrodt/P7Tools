<?php
/**
 * P7Tools\Http\CooperationTest
 *
 * Testing co operating of HTTP components
 *
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.0.23
 */
use P7Tools\Business\Account;

class AccountTest extends \PHPUnit\Framework\TestCase
{

    public function testIfAccountIsSetCorrectlyAsAsset()
    {
        $acc = new Account();
        $this->assertInstanceOf('P7Tools\Business\Account', $acc);
        $this->assertTrue($acc->getBalance() === 0.00);
        $acc->doDebit(23.77);
        $this->assertTrue($acc->getBalance() === 23.77);
        $acc->doCredit(123.77);
        $this->assertTrue($acc->getBalance() === - 100.00);
        $this->assertTrue($acc->getType() === 'Asset');
//         var_dump($acc->getBalance());
    }
    
    
    public function testIfAccountIsSetCorrectlyAsLiability()
    {
        $acc = new Account(55,'Liability');
        $this->assertInstanceOf('P7Tools\Business\Account', $acc);
        $this->assertTrue($acc->getBalance() === 0.00);
        $acc->doDebit(23.77);
        $this->assertTrue($acc->getBalance() === -23.77);
        $acc->doCredit(123.77);
        $this->assertTrue($acc->getBalance() ===  100.00);
        $this->assertTrue($acc->getType() === 'Liability');
        //         var_dump($acc->getBalance());
    }
}


