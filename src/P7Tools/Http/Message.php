<?php declare(strict_types=1); declare(strict_types=1);
/**
<?php declare(strict_types=1); declare(strict_types=1);
/**
 * P7Tools\Http\Message
 *
 * Class representing HTTP requests and responses (header + SEPARATOR () + Body)
 *
 * !Do not use in production until it is stable!
 *
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 */
namespace P7Tools\Http;

class Message extends \P7Tools\Base\Data\Container
{
    public function __construct($message = null)
    {
        $header = null;
        $body = null;
        if(is_string($message) && Parser::isValidMessage($message)) {
            list($header, $body) = Parser::splitMessage($message);
        }
        $data = array('message' => $message, 'header' => $header, 'body' => $body);
        parent::__construct($data);
        $this->setValidKeys(array_keys($data));
    }
}

