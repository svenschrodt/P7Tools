<?php declare(strict_types = 1);
/**
 * \P7Tools\Communication\PhpMail
 *
 * MTA functions implemented with PHP's native mail() function
 *
 * @todo implemnt missing functionality
 * 
 * !Do not use in production until it is stable!
 *      
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 27.11.2019
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace P7Tools\Communication\PhpMail;

use P7Tools\Communication\MailAgentInterface;

final class PhpMail implements MailAgentInterface
{

    /**
     * List of recipients addresses via 'to'
     * @var array
     */
    private $to = array();

    /**
     * List of recipients addresses via 'cc'
     * @var array
     */
    private $cc = array();
    /**
     * List of recipients addresses via 'bcc'
     * @var array
     */
    private $bcc = array();

    /**
     * Subject of current message to be sent 
     * 
     * @var string
     */
    private $subject = '';
    
    
    /**
     * Text of current message to be sent
     *
     * @var string
     */
    private $text = '';
    
    /**
     * List of attachments to be sent with current mail
     *
     * @var string
     */
    private $attachment = array();
    
    /**
     * Adding recipient 'to' 
     * 
     * @param string $recipient
     * @return PhpMail
     */
    public function addTo(string $recipient): PhpMail
    {
        array_push($this->to, $recipient);
        return $this;
    }

    /**
     * Adding list of recipients 'to'
     * 
     * @param array $recipients
     * @return PhpMail
     */
    public function addTos(array $recipients): PhpMail
    {
        array_merge($this->to, $recipients);
        return $this;
    }

    /**
     * Adding recipient 'cc'
     *
     * @param string $recipient
     * @return PhpMail
     */
    public function addCc(string $recipient): PhpMail
    {
        array_push($this->cc, $recipient);
        return $this;
    }
    
    /**
     * Adding list of recipients 'cc'
     *
     * @param array $recipients
     * @return PhpMail
     */
    public function addCcs(array $recipients): PhpMail
    {
        array_merge($this->cc, $recipients);
        return $this;
    }
    
    /**
     * Adding recipient 'bcc'
     *
     * @param string $recipient
     * @return PhpMail
     */
    public function addBcc(string $recipient): PhpMail
    {
        array_push($this->bcc, $recipient);
        return $this;
    }
    
    /**
     * Adding list of recipients 'bcc'
     *
     * @param array $recipients
     * @return PhpMail
     */
    public function addBccs(array $recipients): PhpMail
    {
        array_merge($this->bcc, $recipients);
        return $this;
    }
    
    /**
     * Setting subject text for current mail 
     * 
     * @param string $subject
     * @return PhpMail
     */
    public function setSubject(string $subject): PhpMail
    {
        $this->subject= $subject;
        return $this;
    }

    /**
     * Setting text for current mail
     * 
     * @param string $subject
     * @return PhpMail
     */
    public function setText(string $subject): PhpMail
    {
        $this->textt= $text;
        return $this;
    }

    /**
     * Adding path to filre resources to be attached to current mail
     * 
     * @param string $pathToResource
     * @return PhpMail
     */
    public function addAttachment(string $pathToResource): PhpMail
    {
        array_push($this->attachment, $pathToResource);
        return $this;
    }

    /**
     * Sending current mail
     * 
     * @return bool
     */
    public function send(): bool
    {
        //@todo try .. catch and user friendly error messagges
        $this->_validate();
        $this->_dispatchAttachments();
        $this->_generateHeaders();
            //mail()etc;
    }
    
    /**
     * Validate all mail parameters before sending 
     * 
     * @return boolean
     */
    private function _validate()
    {
        //@todo implement it;-)
        return true;
    }
    
    /**
     * Loading file resources to be attached, encoding it, adding to mail body
     * 
     * @return boolean
     */
    private function _dispatchAttachments()
    {
        //@todo implement it;-)
        return true;
    }
    
    /**
     * Generating smtp headers incl. cc,bcc
     * 
     * @return boolean
     */
    private function _generateHeaders()
    {
        //@todo implement it;-)
        return true;
    }
}
