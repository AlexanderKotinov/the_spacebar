<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 18.10.18
 * Time: 12:30
 */

namespace App\Service;


use Nexy\Slack\Client;

class SlackClient
{
    private $slack;

    public function __construct(Client $slack)
    {
        $this->slack = $slack;
    }

    public function sendMessage(string $from, string $msgText)
    {
        $message = $this->slack->createMessage();

        $message
            ->from($from)
            ->withIcon(':ghost:')
            ->setText($msgText)
        ;

        $this->slack->sendMessage($message);
    }
}