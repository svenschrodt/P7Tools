<?php declare(strict_types=1); declare(strict_types=1);
/* 
 * 
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
