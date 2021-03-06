<?php
/**
 * CooperationTest
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
use P7Tools\Database\Sql\Insert;

use P7Tools\Base\Data\ArrayHelper;
use P7Tools\Dev\CodeCreator;
use P7Tools\Base\Data\Symbol;
use P7Tools\Dev\Expression;

class QueryTest extends \PHPUnit\Framework\TestCase
{

    protected $testContainer;

    public function setUp(): void
    {}

    public function NOtestExprssion()
    {
        $ex = new Expression();
        $ex->let('Foo')->and('BAR');
        echo $ex;
    }

    public function testQuery()
    {
        $q = new Insert([], 'FOO');
        $this->assertTrue(is_object($q));
        // $select = $q->update(array(
        // 'user_name'=>'Pauly',
        // 'email' =>'no-reply@example.net',
        // 'hash'=>md5(uniqid('Bla'))
        // ),'user_account_fr')
        // ->where(array(
        // "last_name <> 'Paulsen",
        // "entry_date BETWEEN '2016-01-12' AND '2016-01-12'",
        // "name='Mary'",
        // 'id' =>99,
        // ))->addOr("name='Peter'");
        // ;
        $q = new Insert([
            'user_name' => 'Pauly',
            'email' => 'no-reply@example.net',
            'hash' => md5(uniqid('Bla')),
            'dob' => '23.05.1949'
        ], 'Freddie');
        $q->into('user_account_fr');
        // echo $q;
        // $select = $q->select(array(
        // 'id',
        // 'user_name',
        // 'email',
        // 'hash'
        // ))->from('user_account_fr')
        // ->where(array(
        // "last_name <> 'Paulsen",
        // "entry_date BETWEEN '2016-01-12' AND '2016-01-12'",
        // "name='Mary'"
        // ))->addOr("name='Peter'")
        // ->orderBy(array('entry_date', 'user_name'))->groupBy('group_id');
        // $select->setConcatType(Query::OP_OR)->limit(23);
        // echo PHP_EOL;
        // echo $q;
        // echo PHP_EOL;

        // $w = new Where();
        // $q->where('a.b >Y 99');
        // $q->where("username LIKE 'Schm%' ");

        // $value = 1.001;
        // $key = 'fNormalizedFactor'
        // $data = array(
        // '$aMapping' => 'array()',
        // 'fNormalizedFactor' => 1.00325,
        // 'radius' => 23.005,
        // 'gUid' => 'FOO' . uniqid()
        // );
        // $e = CodeCreator::getAssignmentList($data, Symbol::SINGLE_QUOTE, true, '', ';' . PHP_EOL);
        // echo CodeCreator::parenthesiseExpression($e);
        // echo CodeCreator::getEnumeration($data);
        // var_dump($data);
        // var_dump(get_magic_quotes_gpc());
    }

    public function testIfQueriessAreSetCorrectly()
    {
        $me = new Insert([
            ' * '
        ], 'Foo');
        
        $this->assertInstanceOf('P7Tools\Database\Sql\Insert', $me);
//         echo ArrayHelper::getArrayAsString($data, true);
    }
}


