<?php
declare(strict_types = 1);
/**
 * \P7Tools\Business\Account
 *
 * (Later Abstract) foundation class for classes representing accounts
 * - basic credit / debit functionality
 *
 * @todo dispatching debit/credit action by account type
 * @todo implement self::$_value as instance of \P7Tools\Business\AbstractCurrency       
 *      
 * !Do not use in production until it is stable!
 *      
 * @see https://en.wikipedia.org/wiki/Debits_and_credits 
 * 
 * Hint for myself:
 *     
 *      [Kind of account]------------- [Debit] --------------- [Credit]
 *      Asset ------------------------ Increase -------------- Decrease
 *      Liability -------------------- Decrease -------------- Increase
 *      Income/Revenue --------------- Decrease -------------- Increase
 *      Expense/Cost/Dividend -------- Increase -------------- Decrease
 *      Equity/Capital --------------- Decrease -------------- Increase
 *     
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 04.12.2019
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace P7Tools\Business;

class Account
{

    /**
     * Number of current account instance
     *
     * @var int
     */
    protected $_accountNumber;

    /**
     * Namer of current account instance
     *
     * @var string
     */
    protected $_accountName;

    /**
     * Balance (bo be updated after credit or debit action)
     *
     * @var float
     */
    protected $_balance = 0.0;

    /**
     * Type of account - default set, for testing
     *
     * @var string
     */
    protected $_type = 'Asset';

    /**
     * Tyapes of accounts
     *
     * @var array
     */
    protected $_validAccountTypes = [
        'Asset',
        'Liability',
        'Income',
        'Revenue',
        'Expense',
        'Cost',
        'Dividend',
        'Equity',
        'Capital'
    ];

    /**
     * Constructor function
     *
     * @param number $no
     * @param string $type
     */
    public function __construct($no = 23, $type = 'Asset')
    {
        $this->_accountName = $this->_getNameByNumber($no);
        $this->_accountNumber = $no;
        $this->_type = $type;
    }

    /**
     * Do debit action
     *
     * @param float $value
     * @return \P7Tools\Business\Account
     */
    public function doDebit(float $value)
    {
        $this->_dispatch('debit', $value);
        return $this;
    }

    /**
     * Do credit action
     *
     * @param float $value
     * @return \P7Tools\Business\Account
     */
    public function doCredit(float $value)
    {
        $this->_dispatch('credit', $value);
        return $this;
    }

    /**
     * Decreasing balance
     *
     * @param float $value
     */
    protected function _increaseBalance(float $value)
    {
        $this->_balance += $value;
    }

    /**
     * Decreasing balance
     *
     * @param float $value
     */
    protected function _decreaseBalance(float $value)
    {
        $this->_balance -= $value;
    }

    /**
     * Dispatching current action (debit | credit) by current account type
     *
     * @param string $action
     * @param float $value
     * @throws \ErrorException
     */
    protected function _dispatch(string $action = 'debit', float $value)
    {
        switch (strtolower($action)) {

            case 'debit':
                $this->_handleDebit($value);
                break;

            case 'credit':
                $this->_handleCredit($value);
                break;

            default:
                // @todo implement new Exception
                throw new \ErrorException('Invalid account type!');
        }
    }

    /**
     * Handling debit action by type
     *
     * @param float $value
     */
    protected function _handleDebit($value)
    {
        switch ($this->_type) {
            case 'Asset':
            case 'Expense':
            case 'Cost':
            case 'Dividend':
                $this->_increaseBalance($value);
                break;
            default:
                $this->_decreaseBalance($value);
        }
    }

    /**
     * Handling credit action by type
     *
     * @param float $value
     */
    protected function _handleCredit(float $value)
    {
        switch ($this->_type) {
            case 'Asset':
            case 'Expense':
            case 'Cost':
            case 'Dividend':
                $this->_decreaseBalance($value);
                break;
            default:
                $this->_increaseBalance($value);
        }
    }

    /**
     * Returning current balance 
     *   (summary of credit ./. debit actions)
     *
     * @return number
     */
    public function getBalance(): float
    {
        return round($this->_balance, 2);
    }

    /**
     * Getting type of current account instance
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->_type;
    }

    /**
     * Getting name of current account instance
     *
     * Tobe overwritten
     *
     * @param int $no
     * @return string
     */
    protected function _getNameByNumber(int $no)
    {
        return 'Foo Account';
    }
}
