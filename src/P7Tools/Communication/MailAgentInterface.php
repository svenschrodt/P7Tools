<?php declare(strict_types=1);
/**
 * P7Tools\lib\Database\ExampleAdapter
 *
 * Interface defining API (methods with visibility public) of classes 
 * with mta (mail transport agent) functionality
 *
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 */
declare(strict_types = 1);
namespace P7Tools\Communication;

interface MailAgentInterface
{
    public function addTo(string $recipient);
    public function setSubject(string $subject); 
    public function setText(string $subject);
    public function addAttachment(string $pathToResource);
    public function send() :bool;
    
}
