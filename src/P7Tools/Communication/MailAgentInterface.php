<?php declare(strict_types = 1);
/**
 * P7Tools\lib\Database\ExampleAdapter
 *
 * Interface defining API (methods with visibility public) of classes
 * with mta (mail transport agent) functionality
 *
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2019-11-25
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace P7Tools\Communication;

interface MailAgentInterface
{

    /**
     * Adding recipient 'to'
     *
     * @param string $recipient
     */
    public function addTo(string $recipient);

    /**
     * Adding list of recipients 'to'
     *
     * @param array $recipients
     * @return MailAgentInterface
     */
    public function addTos(array $recipients): MailAgentInterface;

    /**
     * Adding recipient 'cc'
     *
     * @param string $recipient
     * @return MailAgentInterface
     */
    public function addCc(string $recipient): MailAgentInterface;

    /**
     * Adding list of recipients 'cc'
     *
     * @param array $recipients
     * @return MailAgentInterface
     */
    public function addCcs(array $recipients): MailAgentInterface;

    /**
     * Adding recipient 'bcc'
     *
     * @param string $recipient
     * @return MailAgentInterface
     */
    public function addBcc(string $recipient): MailAgentInterface;

    /**
     * Adding list of recipients 'bcc'
     *
     * @param array $recipients
     * @return MailAgentInterface
     */
    public function addBccs(array $recipients): MailAgentInterface;

    /**
     * Setting subject text for current mail
     *
     * @param string $subject
     * @return MailAgentInterface
     */
    public function setSubject(string $subject): MailAgentInterface;

    /**
     * Setting text for current mail
     *
     * @param string $subject
     * @return MailAgentInterface
     */
    public function setText(string $subject): MailAgentInterface;

    /**
     * Adding path to filre resources to be attached to current mail
     *
     * @param string $pathToResource
     * @return MailAgentInterface
     */
    public function addAttachment(string $pathToResource): MailAgentInterface;

    /**
     * Sending current mail
     *
     * @return bool
     */
    public function send(): bool;
}
