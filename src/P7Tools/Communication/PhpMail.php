<?php declare(strict_types = 1);
/**
 * \P7Tools\Communication\PhpMail
 *
 * MTA functions implemented with PHP's native mail() function
 *
 * @todo !Do not use in production until it is stable!
 *      
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

class PhpMail implements MailAgentInterface
{

    /**
     * Adding recipient 'to'
     *
     * @param string $recipient
     */
    public function addTo(string $recipient) : PhpMail
    {}

    public function addTos(array $recipients) : PhpMail
    {}

    public function setSubject(string $subject) : PhpMail
    {}

    public function setText(string $subject): PhpMail
    {}

    public function addAttachment(string $pathToResource): PhpMail
    {}

    public function send(): bool
    {}
}
